<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);
        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_kategori)
    {
        $category = Category::findOrFail($id_kategori);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_kategori)
    {
        $category = Category::findOrFail($id_kategori);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kategori)
    {
        $category = Category::findOrFail($id_kategori);
        $before = $category->toArray();
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);
        $category->update($validated);
        // Audit log untuk update kategori
        \App\Models\AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'update_category',
            'target_table' => 'categories',
            'target_id' => $category->id_kategori,
            'before' => json_encode($before),
            'after' => json_encode($category->toArray()),
        ]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        $category = Category::findOrFail($id_kategori);
        $before = $category->toArray();
        $category->delete();
        // Audit log untuk hapus kategori
        \App\Models\AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'delete_category',
            'target_table' => 'categories',
            'target_id' => $id_kategori,
            'before' => json_encode($before),
            'after' => null,
        ]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
