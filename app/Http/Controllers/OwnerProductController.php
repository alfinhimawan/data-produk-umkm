<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\UMKMProfile;

class OwnerProductController extends Controller
{
    // List all products owned by the logged-in owner
    public function index()
    {
        $user = \Auth::user();
        if (!$user) {
            $umkm = \App\Models\UMKMProfile::first();
        } else {
            $umkm = \App\Models\UMKMProfile::where('id_users', $user->id_users)->first();
        }
        $products = $umkm ? \App\Models\Product::with(['category', 'umkmProfile'])->where('id_umkm', $umkm->id_umkm)->get() : collect();
        $categories = \App\Models\Category::all();
        $umkmProfiles = \App\Models\UMKMProfile::all();
        return view('owner.products.index', compact('products', 'categories', 'umkmProfiles'));
    }

    // Show form for creating a new product
    public function create()
    {
        $categories = Category::all();
        $umkmProfiles = UMKMProfile::all();
        return view('owner.products.create', compact('categories', 'umkmProfiles'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            $umkm = UMKMProfile::first();
        } else {
            $umkm = UMKMProfile::where('id_users', $user->id_users)->first();
        }
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'id_kategori' => 'required|exists:categories,id_kategori',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validated['id_umkm'] = $umkm->id_umkm;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/products'), $namaFile);
            $validated['foto'] = 'image/products/' . $namaFile;
        }
        Product::create($validated);
        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Show form for editing a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $umkmProfiles = UMKMProfile::all();
        return view('owner.products.edit', compact('product', 'categories', 'umkmProfiles'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'id_kategori' => 'required|exists:categories,id_kategori',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            if ($product->foto && file_exists(public_path($product->foto))) {
                unlink(public_path($product->foto));
            }
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/products'), $namaFile);
            $validated['foto'] = 'image/products/' . $namaFile;
        }
        $product->update($validated);
        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('owner.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
