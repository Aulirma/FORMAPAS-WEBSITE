<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Membeli; // Pastikan Model ini sudah diupdate $fillable-nya

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // 1. Cek Login (Security)
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'Sesi habis, silakan login kembali.'
            ], 401);
        }

        // 2. Validasi Input
        $request->validate([
            'nama'   => 'required|string',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string',
            'cart'   => 'required|array|min:1', // Keranjang tidak boleh kosong
        ]);

        try {
            // Mulai Transaksi Database (Agar data aman, masuk semua atau tidak sama sekali)
            DB::beginTransaction();

            // 3. Generate Kode Transaksi Unik
            // Format: TRX-TAHUNBULANTANGGAL-JAMMENITDETIK (Cth: TRX-20231225-103005)
            $trxId = 'TRX-' . date('Ymd-His');
            
            // Ambil NIK User yang sedang login
            $userNik = Auth::user()->NIK; 

            // 4. Looping Keranjang (Simpan setiap item ke database)
            foreach ($request->cart as $item) {
                
                // Hitung subtotal per item (Harga x Qty)
                $subtotal = $item['price'] * $item['qty'];

                Membeli::create([
                    'trx_id'            => $trxId,
                    'NIK'               => $userNik,
                    'ID_PRODUCT'        => $item['id'], // ID ini dikirim dari JS
                    'qty'               => $item['qty'],
                    'total_harga'       => $subtotal, 
                    
                    // Data Pengiriman (Akan sama untuk setiap baris barang dalam 1 checkout)
                    'nama_penerima'     => $request->nama,
                    'alamat_pengiriman' => $request->alamat,
                    'no_wa'             => $request->no_hp,
                    'status'            => 'MENUNGGU' // Default status
                ]);
            }

            // Simpan permanen ke database
            DB::commit();

            // 5. Kirim respon sukses ke JavaScript
            return response()->json([
                'success' => true, 
                'message' => 'Pesanan berhasil dibuat!',
                'trx_id'  => $trxId
            ]);

        } catch (\Exception $e) {
            // Jika ada error, batalkan semua penyimpanan
            DB::rollBack();
            
            return response()->json([
                'success' => false, 
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
}