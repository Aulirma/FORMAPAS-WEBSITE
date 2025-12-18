<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /* =======================
     | UPDATE PASSWORD
     =======================*/
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'old_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = Auth::user();

        if (empty($user->USER_PASSWORD)) {
            return back()->withErrors([
                'old_password' => 'Password belum tersimpan dengan benar'
            ]);
        }

        if (!Hash::check($request->old_password, $user->USER_PASSWORD)) {
            return back()->withErrors([
                'old_password' => 'Password lama salah'
            ]);
        }

        $user->USER_PASSWORD = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

    /* =======================
     | UPDATE EMAIL
     =======================*/
    public function updateEmail(Request $request)
    {
        $request->validate([
            'USER_EMAIL' => 'required|email|unique:formuser,USER_EMAIL,' . Auth::user()->NIK . ',NIK',
        ], [
            'USER_EMAIL.required' => 'Email wajib diisi',
            'USER_EMAIL.email' => 'Format email tidak valid',
            'USER_EMAIL.unique' => 'Email sudah digunakan',
        ]);

        $user = Auth::user();
        $user->USER_EMAIL = $request->USER_EMAIL;
        $user->save();

        return back()->with('success', 'Email berhasil diperbarui');
    }

    /* =======================
     | DELETE ACCOUNT
     =======================*/
    public function deleteAccount()
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }

    public function merchHistory()
    {
        // 1. Ambil NIK user yang sedang login
        $nik = Auth::user()->NIK;

        // 2. Ambil data pembelian, di-join dengan tabel product biar dapat nama & gambar
        $history = DB::table('membeli')
            ->join('product', 'membeli.ID_PRODUCT', '=', 'product.ID_PRODUCT')
            ->where('membeli.NIK', $nik) // Filter cuma punya user ini
            ->select('membeli.*', 'product.NAMA_PRODUCT', 'product.FOTO_PRODUCT')
            ->orderBy('membeli.created_at', 'desc') // Yang terbaru di atas
            ->get();

        // 3. Kirim data $history ke view
        return view('user.merch', compact('history'));
    }
}
