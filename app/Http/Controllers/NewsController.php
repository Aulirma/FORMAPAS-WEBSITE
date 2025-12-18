<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table('news')->orderBy('updated_at', 'desc')->get();
        return view('admin.news', compact('news'));
    }
    public function home()
    {
        $news = DB::table('news')->orderBy('updated_at', 'desc')->take(6)->get();
        return view('index', compact('news'));
    }


    public function create(Request $request)
    {
        $request->validate([
            'JUDUL_NEWS' => 'required|string',
            'ISI_NEWS'   => 'required|string',
            'FOTO_NEWS'  => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        // proses upload
        $fotoPath = null;
        if ($request->hasFile('FOTO_NEWS')) {
            $fotoPath = $request->file('FOTO_NEWS')->store('news', 'public');
        }

        DB::table('news')->insert([
            'JUDUL_NEWS'   => $request->JUDUL_NEWS,
            'ISI_NEWS'     => $request->ISI_NEWS,
            'LOKASI_NEWS'  => $request->LOKASI_NEWS,
            'FOTO_NEWS'    => $fotoPath,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'JUDUL_NEWS' => 'required|string',
            'ISI_NEWS' => 'required|string',
        ]);

        DB::table('news')->where('NO_NEWS', $id)->update([
            'JUDUL_NEWS' => $request->JUDUL_NEWS,
            'ISI_NEWS' => $request->ISI_NEWS,
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy($id)
    {
        DB::table('news')->where('NO_NEWS', $id)->delete();
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
