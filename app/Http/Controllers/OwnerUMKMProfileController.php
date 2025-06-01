<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UMKMProfile;

class OwnerUMKMProfileController extends Controller
{
    // Store new UMKM Profile for owner
    public function store(Request $request)
    {
        $user = Auth::user();
        $existing = UMKMProfile::where('id_users', $user->id_users)->first();
        if ($existing) {
            return redirect()->route('owner.umkm-profile')->with('warning', 'Profil UMKM sudah ada.');
        }
        $validated = $request->validate([
            'nama_umkm' => 'required|string|max:150',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validated['id_users'] = $user->id_users;
        $validated['status'] = 'aktif';
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $namaFile = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('image/logo'), $namaFile);
            $validated['logo'] = 'image/logo/' . $namaFile;
        }
        UMKMProfile::create($validated);
        return redirect()->route('owner.umkm-profile')->with('success', 'Profil UMKM berhasil ditambahkan!');
    }

    // Update UMKM Profile for owner
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $umkm = UMKMProfile::where('id_umkm', $id)->where('id_users', $user->id_users)->firstOrFail();
        $validated = $request->validate([
            'nama_umkm' => 'required|string|max:150',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            if ($umkm->logo && file_exists(public_path($umkm->logo))) {
                @unlink(public_path($umkm->logo));
            }
            $logo = $request->file('logo');
            $namaFile = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('image/logo'), $namaFile);
            $validated['logo'] = 'image/logo/' . $namaFile;
        }
        $umkm->update($validated);
        return redirect()->route('owner.umkm-profile')->with('success', 'Profil UMKM berhasil diupdate!');
    }
}
