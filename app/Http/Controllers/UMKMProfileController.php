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
    public function create() {
        return redirect()->route('umkm-profiles.index')->with('error', 'Admin tidak diizinkan menambah UMKM!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        return redirect()->route('umkm-profiles.index')->with('error', 'Admin tidak diizinkan menambah UMKM!');
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
    public function edit($id) {
        return redirect()->route('umkm-profiles.index')->with('error', 'Admin tidak diizinkan mengedit UMKM!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        return redirect()->route('umkm-profiles.index')->with('error', 'Admin tidak diizinkan mengedit UMKM!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkmProfile = UMKMProfile::findOrFail($id);
        $before = $umkmProfile->toArray();
        $umkmProfile->delete();
        // Audit log untuk hapus UMKM oleh admin
        \App\Models\AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'delete_umkm_profile',
            'target_table' => 'umkm_profiles',
            'target_id' => $id,
            'before' => json_encode($before),
            'after' => null,
        ]);
        return redirect()->route('umkm-profiles.index')->with('success', 'UMKM Profile berhasil dihapus.');
    }

    // Tambahkan method untuk nonaktifkan UMKM
    public function setStatus($id, $status)
    {
        $umkmProfile = UMKMProfile::findOrFail($id);
        $before = $umkmProfile->toArray();
        $umkmProfile->status = $status;
        $umkmProfile->save();
        // Audit log untuk update status UMKM oleh admin
        \App\Models\AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'update_status_umkm_profile',
            'target_table' => 'umkm_profiles',
            'target_id' => $id,
            'before' => json_encode($before),
            'after' => json_encode($umkmProfile->toArray()),
        ]);
        return redirect()->route('umkm-profiles.index')->with('success', 'Status UMKM berhasil diubah.');
    }
}
