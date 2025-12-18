<?php

namespace App\Http\Controllers;
use App\Models\Seleksi;
use Illuminate\Http\Request;

class AdminSeleksiController extends Controller
{
    public function updateSeleksi(Request $request, $id)
    {
        $seleksi = Seleksi::findOrFail($id);
        $keputusan = $request->keputusan; // 'lolos' atau 'gagal'

        // LOGIKA OTOMATIS BERDASARKAN TAHAP SAAT INI
        
        // 1. Cek Tahap 1
        if ($seleksi->status_tahap_1 == 'menunggu') {
            $seleksi->status_tahap_1 = $keputusan;
            // Jika gagal tahap 1, tahap 2 dikunci selamanya (opsional)
        } 
        // 2. Cek Tahap 2
        elseif ($seleksi->status_tahap_2 == 'menunggu') {
            $seleksi->status_tahap_2 = $keputusan;
        } 
        // 3. Cek Final
        elseif ($seleksi->sudah_wawancara && $seleksi->status_final == 'menunggu') {
            // Untuk final, statusnya 'lulus' atau 'tidak_lulus'
            $statusFinal = ($keputusan == 'lolos') ? 'lulus' : 'tidak_lulus';
            $seleksi->status_final = $statusFinal;
        }

        $seleksi->save();

        return redirect()->back()->with('success', 'Status seleksi berhasil diperbarui!');
    }
}