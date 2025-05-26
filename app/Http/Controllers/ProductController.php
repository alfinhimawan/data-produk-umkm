<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UMKMProfile;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['umkmProfile', 'category'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $umkmProfiles = UMKMProfile::all();
        $categories = Category::all();
        return view('products.create', compact('umkmProfiles', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_umkm' => 'required|exists:umkm_profiles,id_umkm',
            'id_kategori' => 'required|exists:categories,id_kategori',
            'nama_produk' => 'required|string|max:150',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|string|max:255',
        ]);
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['umkmProfile', 'category'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $umkmProfiles = UMKMProfile::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'umkmProfiles', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'id_umkm' => 'required|exists:umkm_profiles,id_umkm',
            'id_kategori' => 'required|exists:categories,id_kategori',
            'nama_produk' => 'required|string|max:150',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|string|max:255',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
