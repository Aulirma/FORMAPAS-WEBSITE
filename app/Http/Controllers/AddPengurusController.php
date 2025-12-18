<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddPengurusController extends Controller
{

    public function index()
    {
        $pengurus = Pengurus::all();
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name'       => 'required',
            'position'   => 'required',
            'department' => 'required',
            'image'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Foto
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foto-pengurus', 'public');
        }

        // Simpan
        Pengurus::create([
            'name'       => $request->name,
            'position'   => $request->position,
            'department' => $request->department,
            'image'      => $imagePath,
            'whatsapp'   => $request->whatsapp,
            'instagram'  => $request->instagram,
            'email'      => $request->email
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Pengurus Berhasil Ditambahkan!');
    }

    public function destroy($id)
    {
        $data = Pengurus::findOrFail($id);

        // Hapus foto lama jika ada
        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Data Berhasil Dihapus!');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $request->validate([
            'name'       => 'required',
            'position'   => 'required',
            'department' => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama biar server tidak penuh
            if ($pengurus->image) {
                Storage::disk('public')->delete($pengurus->image);
            }
            $imagePath = $request->file('image')->store('foto-pengurus', 'public');
            $pengurus->image = $imagePath;
        }

        // Update data teks
        $pengurus->update([
            'name'       => $request->name,
            'position'   => $request->position,
            'department' => $request->department,
            'whatsapp'   => $request->whatsapp,
            'instagram'  => $request->instagram,
            'email'      => $request->email
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Data Berhasil Diupdate!');
    }

}