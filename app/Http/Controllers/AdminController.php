<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Seleksi;
use App\Models\Membeli; // PASTIKAN INI DITAMBAHKAN
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /* ======================================================
       1. AUTHENTICATION (LOGIN & LOGOUT)
    ====================================================== */
    public function loginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        
        $admin = DB::table('formadmin')
            ->where('ADMIN_NAME', $username)
            ->first();
            
        if (!$admin) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        $hashedInput = hash('sha256', $password);
        if ($hashedInput !== $admin->ADMIN_PASSWORD) {
            return back()->with('error', 'Password salah');
        }

        // Login berhasil → simpan session
        session(['admin_id' => $admin->ADMIN_ID]);
        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect('/index');
    }

    /* ======================================================
       2. DASHBOARD
    ====================================================== */
    public function dashboard(Request $request)
    {
        if (!session('admin_id')) return redirect('/admin/login');

        $admin = DB::table('formadmin')->where('ADMIN_ID', session('admin_id'))->first();
        
        // Data Statistik
        $recentOrders = Membeli::select('trx_id', 'nama_penerima', 'created_at', DB::raw('SUM(total_harga) as total_bayar'))
                ->where('status', 'MENUNGGU')
                ->groupBy('trx_id', 'nama_penerima', 'created_at')
                ->orderBy('created_at', 'asc') 
                ->limit(5)
                ->get();
        $latestNews = DB::table('news')->orderBy('NO_NEWS', 'desc')->limit(5)->get();
        $latestUsers = DB::table('formuser')->orderBy('NIK', 'desc')->limit(5)->get();
        $latestMerch = DB::table('product')->orderBy('ID_PRODUCT', 'desc')->limit(5)->get();
        
        // Hitung Pesanan Menunggu (Tambahan Baru)
        $pendingOrders = Membeli::where('status', 'MENUNGGU')->distinct('trx_id')->count('trx_id');

        // Data KKN
        $status = $request->get('status', 'menunggu');
        $pendaftar = DB::table('pendaftar_kkn')
            ->where('status', $status)
            ->orderBy('tanggal_ajuan', 'desc')
            ->limit(10)
            ->get();

        $seleksi_pending = Seleksi::with('user') 
            ->where('status_tahap_1', 'menunggu')
            ->orWhere('status_tahap_2', 'menunggu')
            ->orWhere(function($query) {
                $query->where('sudah_wawancara', true)
                    ->where('status_final', 'menunggu');
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'admin', 'latestNews', 'latestUsers', 'latestMerch', 'pendaftar', 'status', 'pendingOrders', 'recentOrders', 'seleksi_pending'
        ));    
    }

    /* ======================================================
       3. MANAGEMEN KKN
    ====================================================== */
    public function kkn()
    {
        if (!session('admin_id')) return redirect('/admin/login');

        $pendaftar = DB::table('pendaftar_kkn')
            ->orderBy('tanggal_ajuan', 'desc')
            ->get();

        return view('admin.kkn', compact('pendaftar'));
    }

    public function approveKKN($id)
    {
        DB::table('pendaftar_kkn')->where('id', $id)->update([
            'status' => 'DISETUJUI',
            'tanggal_konfirmasi' => now()->toDateString()
        ]);
        return back();
    }

    public function rejectKKN($id)
    {
        DB::table('pendaftar_kkn')->where('id', $id)->update([
            'status' => 'DITOLAK',
            'tanggal_konfirmasi' => now()->toDateString()
        ]);
        return back();
    }

    /* ======================================================
       4. FORMAPALS (USER MANAGEMENT)
    ====================================================== */
    public function formapals()
    {
        if (!session('admin_id')) return redirect('/admin/login');

        $users = DB::table('formuser')->orderBy('NIK', 'desc')->get();
        return view('admin.formapals', compact('users'));
    }

    public function deleteFormapals($nik)
    {
        if (!session('admin_id')) return redirect('/admin/login');

        DB::table('formuser')->where('NIK', $nik)->delete();
        return redirect()->route('formapals')->with('success', 'User berhasil dihapus.');
    }

    /* ======================================================
       5. MANAGEMEN PRODUCT (MERCH)
    ====================================================== */
    public function merch()
    {
        // Menggunakan model Product sesuai request
        $products = Product::orderBy('ID_PRODUCT','desc')->get();
        return view('admin.merch', compact('products'));
    }

    public function storeMerch(Request $request)
    {
        $request->validate([
            'NAMA_PRODUCT'  => 'required|string|max:255',
            'JENIS_PRODUCT' => 'required|in:Clothing,Accessories,Stationery,Bundling',
            'HARGA_PRODUCT' => 'required|numeric|min:0',
            'FOTO_PRODUCT'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('FOTO_PRODUCT')->store('products', 'public');

        Product::create([
            'NAMA_PRODUCT'  => $request->NAMA_PRODUCT,
            'JENIS_PRODUCT' => $request->JENIS_PRODUCT,
            'HARGA_PRODUCT' => $request->HARGA_PRODUCT,
            'FOTO_PRODUCT'  => $path,
            'ADMIN_ID'      => session('admin_id') ?? null, // Sesuaikan dengan session manual kamu
        ]);

        return redirect()->route('admin.merch')->with('success','Product berhasil ditambahkan');
    }

    public function deleteMerch($id)
    {
        $product = Product::where('ID_PRODUCT',$id)->firstOrFail();

        if ($product->FOTO_PRODUCT && Storage::disk('public')->exists($product->FOTO_PRODUCT)) {
            Storage::disk('public')->delete($product->FOTO_PRODUCT);
        }

        $product->delete();
        return redirect()->route('admin.merch')->with('success','Product berhasil dihapus');
    }

    /* ======================================================
       6. ORDER MANAGEMENT (BARU DITAMBAHKAN)
    ====================================================== */
    
    // A. Tampilkan Daftar Pesanan
    public function orders()
    {
        if (!session('admin_id')) return redirect('/admin/login');

        // Group by TRX_ID untuk meringkas 1 transaksi menjadi 1 baris di tabel
        $orders = Membeli::select(
                'trx_id', 
                'nama_penerima', 
                'status', 
                'created_at', 
                'no_wa',
                DB::raw('SUM(total_harga) as grand_total'), // Hitung total belanja
                DB::raw('COUNT(*) as total_item') // Hitung jumlah jenis barang
            )
            ->groupBy('trx_id', 'nama_penerima', 'status', 'created_at', 'no_wa')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // B. Lihat Detail Pesanan
    public function showOrder($trxId)
    {
        if (!session('admin_id')) return redirect('/admin/login');

        // Ambil data detail barang + join ke tabel product untuk nama & gambar
        // Disesuaikan: 'product' adalah nama tabel, 'ID_PRODUCT' adalah PK
        $items = Membeli::where('trx_id', $trxId)
                ->join('product', 'membeli.ID_PRODUCT', '=', 'product.ID_PRODUCT') 
                ->select('membeli.*', 'product.NAMA_PRODUCT', 'product.FOTO_PRODUCT')
                ->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Pesanan tidak ditemukan');
        }

        // Ambil data header pembeli dari baris pertama
        $buyer = $items->first();

        return view('admin.orders.show', compact('items', 'buyer'));
    }

    // C. Setujui Pesanan
    public function approveOrder($trxId)
    {
        if (!session('admin_id')) return redirect('/admin/login');

        // Update semua barang dengan ID Transaksi tersebut menjadi SIAP_KIRIM
        Membeli::where('trx_id', $trxId)
            ->update(['status' => 'SIAP_KIRIM','updated_at' => now()
        ]);

        return back()->with('success', 'Pesanan berhasil disetujui & siap dikirim!');
    }

}