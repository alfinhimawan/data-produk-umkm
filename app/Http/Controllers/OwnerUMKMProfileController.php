<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        try {
            $user = Auth::user();
            $umkm = UMKMProfile::where('id_umkm', $id)->where('id_users', $user->id_users)->firstOrFail();
            $customMessages = [
                'logo.max' => 'Ukuran gambar tidak sesuai, maksimal 2MB. Silakan pilih gambar lain.',
            ];
            $validated = $request->validate([
                'nama_umkm' => 'sometimes|required|string|max:150',
                'alamat' => 'sometimes|required|string',
                'kontak' => 'sometimes|required|string|max:50',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], $customMessages);

            Log::debug('Request update UMKM', $request->all());
            Log::debug('Validated data', $validated);
            if ($request->hasFile('logo')) {
                Log::debug('Ada file logo yang diupload');
                if ($umkm->logo && file_exists(public_path($umkm->logo))) {
                    $deleted = @unlink(public_path($umkm->logo));
                    Log::debug('Logo lama dihapus', ['deleted' => $deleted, 'path' => $umkm->logo]);
                }
                $logo = $request->file('logo');
                $namaFile = time() . '_' . preg_replace('/\s+/', '_', $logo->getClientOriginalName());
                $logo->move(public_path('image/logo'), $namaFile);
                $umkm->logo = 'image/logo/' . $namaFile;
                Log::debug('Logo baru diupload', ['path' => $umkm->logo]);
            }
            $before = $umkm->toArray();
            if (isset($validated['nama_umkm'])) $umkm->nama_umkm = $validated['nama_umkm'];
            if (isset($validated['alamat'])) $umkm->alamat = $validated['alamat'];
            if (isset($validated['kontak'])) $umkm->kontak = $validated['kontak'];
            $umkm->save();
            // Audit log untuk update UMKM oleh owner
            \App\Models\AuditLog::create([
                'id_users' => auth()->id(),
                'action' => 'update_umkm_profile',
                'target_table' => 'umkm_profiles',
                'target_id' => $umkm->id_umkm,
                'before' => json_encode($before),
                'after' => json_encode($umkm->toArray()),
            ]);
            Log::debug('UMKM berhasil diupdate', $umkm->toArray());
            return redirect()->route('owner.umkm-profile')->with('success', 'Profil UMKM berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Gagal update UMKM: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('owner.umkm-profile')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
