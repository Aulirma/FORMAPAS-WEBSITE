<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;

class HalamanPengurusController extends Controller
{
    public function index()
    {
        // Ambil data dan pisahkan per departemen
        $bph = Pengurus::where('department', 'bph')->get();
        $sosling = Pengurus::where('department', 'sosling')->get();
        $huminfo = Pengurus::where('department', 'huminfo')->get();

        return view('pengurus', compact('bph', 'sosling', 'huminfo'));
    }
}