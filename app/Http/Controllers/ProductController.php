<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /* ============================
     |  HALAMAN TOKO (PUBLIC)
     |  product default + product DB
     ============================ */
    public function index()
    {
        // product hasil inovasi (dari database)
        $products = Product::orderBy('ID_PRODUCT', 'DESC')->get();

        return view('shop.index', compact('products'));
    }

    /* ============================
     |  HALAMAN ADMIN PRODUCT
     ============================ */
    public function adminIndex()
    {
        $products = Product::orderBy('ID_PRODUCT', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    /* ============================
     |  SIMPAN PRODUCT BARU
     ============================ */
    public function store(Request $request)
    {
        $request->validate([
            'NAMA_PRODUCT'  => 'required|string|max:255',
            'JENIS_PRODUCT' => 'required|in:Clothing,Accessories,Stationery,Bundling',
            'HARGA_PRODUCT' => 'required|integer|min:0',
            'FOTO_PRODUCT'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto
        $path = $request->file('FOTO_PRODUCT')
                        ->store('products', 'public');

        // simpan ke database
        Product::create([
            'ADMIN_ID'     => auth()->id(),
            'NAMA_PRODUCT' => $request->NAMA_PRODUCT,
            'JENIS_PRODUCT'=> $request->JENIS_PRODUCT,
            'HARGA_PRODUCT'=> $request->HARGA_PRODUCT,
            'FOTO_PRODUCT' => $path,
        ]);

        return redirect()->back()->with('success','Produk berhasil ditambahkan');
    }

    /* ============================
     |  UPDATE PRODUCT
     ============================ */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'NAMA_PRODUCT'  => 'required|string|max:255',
            'JENIS_PRODUCT' => 'required|in:Clothing,Accessories,Stationery,Bundling',
            'HARGA_PRODUCT' => 'required|integer|min:0',
            'FOTO_PRODUCT'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // kalau upload foto baru
        if ($request->hasFile('FOTO_PRODUCT')) {
            if ($product->FOTO_PRODUCT) {
                Storage::disk('public')->delete($product->FOTO_PRODUCT);
            }
            $product->FOTO_PRODUCT = $request->file('FOTO_PRODUCT')
                                              ->store('products', 'public');
        }

        $product->update([
            'NAMA_PRODUCT'  => $request->NAMA_PRODUCT,
            'JENIS_PRODUCT' => $request->JENIS_PRODUCT,
            'HARGA_PRODUCT' => $request->HARGA_PRODUCT,
        ]);

        return redirect()->back()->with('success','Produk berhasil diupdate');
    }

    /* ============================
     |  HAPUS PRODUCT
     ============================ */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->FOTO_PRODUCT) {
            Storage::disk('public')->delete($product->FOTO_PRODUCT);
        }

        $product->delete();

        return redirect()->back()->with('success','Produk berhasil dihapus');
    }
}
