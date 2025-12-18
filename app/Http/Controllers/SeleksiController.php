<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seleksi;
use App\Models\FormUser; // Model User kamu
use Illuminate\Support\Facades\Auth;

class SeleksiController extends Controller
{
    
    public function index()
    {
        // Ambil User yang sedang Login
        // Karena kamu pakai guard/model sendiri, pastikan ini sesuai
        // Asumsi: Kamu menggunakan Auth custom atau session
        // Jika pakai Auth bawaan Laravel: $user = Auth::user();
        
        // SEMENTARA: Kita ambil user dummy atau dari session login kamu
        // Nanti sesuaikan dengan cara login di sistemmu
        $user = Auth::guard('web')->user(); // Sesuaikan guard jika perlu

        if (!$user) {
            return redirect()->route('login'); // Tendang kalau belum login
        }

        // Cari Data Seleksi milik user ini
        $seleksi = Seleksi::where('nik', $user->NIK)->first();

        // Jika belum pernah daftar sama sekali, buat data kosong (draft)
        if (!$seleksi) {
            $seleksi = Seleksi::create(['nik' => $user->NIK]);
        }

        return view('user.Seleksi', compact('seleksi', 'user'));
    }

    // 2. PROSES TAHAP 1 (ADMINISTRASI) -> Redirect WA
    public function storeTahap1(Request $request)
    {
        $request->validate(['nama_lengkap' => 'required']);
        $user = Auth::user();

        // Update Database
        $seleksi = Seleksi::where('nik', $user->NIK)->first();
        $seleksi->update([
            'nama_lengkap' => $request->nama_lengkap,
            // Status jangan langsung 'lolos', tapi 'menunggu' admin
            'status_tahap_1' => 'menunggu' 
        ]);

        // Siapkan Pesan WA
        $nomorAdmin = '6281226477210'; // GANTI dengan nomor WA Admin
        $pesan = "Halo Admin, saya {$request->nama_lengkap} (NIK: {$user->NIK}) telah mengisi form Tahap 1. Berikut saya lampirkan berkas CV, KTM, dan Transkrip saya sebagai konfirmasi.";
        
        // Encode pesan agar aman di URL
        $textEncoded = urlencode($pesan);
        
        // Redirect ke WA
        return redirect()->away("https://wa.me/{$nomorAdmin}?text={$textEncoded}");
    }

    // 3. PROSES TAHAP 2 (ESSAY) -> Redirect WA
    public function storeTahap2(Request $request)
    {
        $request->validate(['judul_essay' => 'required']);
        $user = Auth::user();

        // Update Database
        $seleksi = Seleksi::where('nik', $user->NIK)->first();
        $seleksi->update([
            'judul_essay' => $request->judul_essay,
            'status_tahap_2' => 'menunggu'
        ]);

        // Siapkan Pesan WA
        $nomorAdmin = '6281226477210'; // GANTI dengan nomor WA Admin
        $pesan = "Halo Admin, saya {$user->USER_NAME} (NIK: {$user->NIK}) telah mengirim Judul Essay: '{$request->judul_essay}'. Berikut saya lampirkan file PDF essay saya.";
        
        $textEncoded = urlencode($pesan);
        
        return redirect()->away("https://wa.me/{$nomorAdmin}?text={$textEncoded}");
    }

    // 4. PROSES TAHAP 3 (WAWANCARA)
    public function storeTahap3()
    {
        $user = Auth::user();
        $seleksi = Seleksi::where('nik', $user->NIK)->first();

        $seleksi->update([
            'sudah_wawancara' => true
        ]);

        return redirect()->back()->with('success', 'Status wawancara berhasil disimpan!');
    }
}