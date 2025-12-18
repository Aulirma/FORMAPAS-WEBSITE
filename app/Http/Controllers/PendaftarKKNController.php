<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarKKN;
use Illuminate\Support\Facades\Auth;

class PendaftarKKNController extends Controller
{
    public function index()
    {
        $pendaftaran = PendaftarKKN::where('nik', Auth::user()->NIK)->first();

        return view('user.daftarKKN', compact('pendaftaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'universitas'  => 'required|string|max:255',
            'tahun_masuk'  => 'required|digits:4',
            'ttl'          => 'required|string|max:255',
            'foto'         => 'required|image|max:2048',
        ]);

        // cegah daftar dua kali
        if (PendaftarKKN::where('nik', Auth::user()->NIK)->exists()) {
            return back();
        }

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('foto_kkn', 'public');
        }

        PendaftarKKN::create([
            'nik' => Auth::user()->NIK,
            'nama_lengkap' => $request->nama_lengkap,
            'universitas'  => $request->universitas,
            'tahun_masuk'  => $request->tahun_masuk,
            'ttl'          => $request->ttl,
            'foto'         => $path,
            'status'       => 'menunggu',
            'tanggal_ajuan'=> now()->toDateString(),
        ]);

        return redirect()->route('user.daftar');
    }
}
