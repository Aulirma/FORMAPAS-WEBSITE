<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function store(Request $request) {
        $request->validate([
            'NAMA_PRODUCT' => 'required',
            'JENIS_PRODUCT' => 'required',
            'HARGA_PRODUCT' => 'required|numeric',
            'FOTO_PRODUCT' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('FOTO_PRODUCT')->store('product', 'public');

        Product::create([
            'ADMIN_ID' => auth()->id(),
            'NAMA_PRODUCT' => $request->NAMA_PRODUCT,
            'JENIS_PRODUCT' => $request->JENIS_PRODUCT,
            'HARGA_PRODUCT' => $request->HARGA_PRODUCT,
            'FOTO_PRODUCT' => $path
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }
}