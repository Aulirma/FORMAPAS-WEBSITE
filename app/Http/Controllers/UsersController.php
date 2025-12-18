<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Membeli;

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

    /* =======================
     | MERCH HISTORY
     =======================*/
    public function merchHistory()
    {
        $nik = Auth::user()->NIK;

        $history = DB::table('membeli')
            ->join('product', 'membeli.ID_PRODUCT', '=', 'product.ID_PRODUCT')
            ->where('membeli.NIK', $nik)
            ->select('membeli.*', 'product.NAMA_PRODUCT', 'product.FOTO_PRODUCT')
            ->orderBy('membeli.created_at', 'desc')
            ->get();

        return view('user.merch', compact('history'));
    }

    /* =====================================================
     | KONFIRMASI BARANG DITERIMA
     | SIAP_KIRIM → SELESAI
     ===================================================== */
    public function confirmOrderReceived($trxId)
    {
        $nik = Auth::user()->NIK;

        $updated = Membeli::where('trx_id', $trxId)
            ->where('NIK', $nik)
            ->where('status', 'SIAP_KIRIM')
            ->update([
                'status' => 'SELESAI',
                'updated_at' => now()
            ]);

        if ($updated === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak valid atau belum dikirim'
            ], 403);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
