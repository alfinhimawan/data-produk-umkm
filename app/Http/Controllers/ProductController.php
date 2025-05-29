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
    public function index(Request $request)
    {
        $query = Product::with(['umkmProfile', 'category']);
        if ($request->filled('nama')) {
            $query->where('nama_produk', 'like', '%' . $request->nama . '%');
        }
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('umkm')) {
            $query->where('id_umkm', $request->umkm);
        }
        if ($request->filled('status')) {
            $query->whereHas('umkmProfile', function($q) use ($request) {
                $q->where('status', $request->status);
            });
        }
        $products = $query->get();
        $categories = Category::all();
        $umkmProfiles = UMKMProfile::all();
        return view('admin.products.index', compact('products', 'categories', 'umkmProfiles', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $umkmProfiles = UMKMProfile::all();
        $categories = Category::all();
        return view('admin.products.create', compact('umkmProfiles', 'categories'));
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/products'), $namaFile);
            $validated['foto'] = 'image/products/' . $namaFile;
        }
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['umkmProfile', 'category'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $umkmProfiles = UMKMProfile::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'umkmProfiles', 'categories'));
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
