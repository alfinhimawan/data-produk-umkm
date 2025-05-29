<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UMKMProfile;
use App\Models\User;

class UMKMProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkmProfiles = UMKMProfile::with('user')->get();
        return view('admin.umkm_profiles.index', compact('umkmProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.umkm_profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_users' => 'required|exists:users,id_users',
            'nama_umkm' => 'required|string|max:150',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $namaFile = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('image/logo'), $namaFile);
            $validated['logo'] = 'image/logo/' . $namaFile;
        }
        UMKMProfile::create($validated);
        return redirect()->route('umkm-profiles.index')->with('success', 'UMKM Profile berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $umkmProfile = UMKMProfile::with('user')->findOrFail($id);
        return view('admin.umkm_profiles.show', compact('umkmProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $umkmProfile = UMKMProfile::findOrFail($id);
        $users = User::all();
        return view('admin.umkm_profiles.edit', compact('umkmProfile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $umkmProfile = UMKMProfile::findOrFail($id);
        $validated = $request->validate([
            'id_users' => 'required|exists:users,id_users',
            'nama_umkm' => 'required|string|max:150',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            if ($umkmProfile->logo && file_exists(public_path($umkmProfile->logo))) {
                unlink(public_path($umkmProfile->logo));
            }
            $logo = $request->file('logo');
            $namaFile = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('image/logo'), $namaFile);
            $validated['logo'] = 'image/logo/' . $namaFile;
        }
        $umkmProfile->update($validated);
        return redirect()->route('umkm-profiles.index')->with('success', 'UMKM Profile berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkmProfile = UMKMProfile::findOrFail($id);
        $umkmProfile->delete();
        return redirect()->route('umkm-profiles.index')->with('success', 'UMKM Profile berhasil dihapus.');
    }
}
