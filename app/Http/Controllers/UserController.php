<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Paksa role dan status hanya bisa admin/aktif
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validated['role'] = 'admin';
        $validated['status'] = 'aktif';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/users'), $namaFile);
            $validated['foto'] = 'image/users/' . $namaFile;
        }
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_users)
    {
        $user = User::findOrFail($id_users);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_users)
    {
        $user = User::findOrFail($id_users);
        // Hapus pembatasan: admin bisa edit akun owner manapun
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_users)
    {
        $user = User::findOrFail($id_users);
        // Admin hanya bisa update status owner, tidak bisa update data owner lain
        if ($user->role === 'umkm_owner') {
            if ($request->has('status')) {
                $oldStatus = $user->status;
                $user->update(['status' => $request->status]);
                // Audit log untuk update status owner
                AuditLog::create([
                    'id_users' => auth()->id(),
                    'action' => 'update_status',
                    'target_table' => 'users',
                    'target_id' => $user->id_users,
                    'before' => json_encode(['status' => $oldStatus]),
                    'after' => json_encode(['status' => $request->status]),
                ]);
                return redirect()->route('users.index')->with('success', 'Status user berhasil diubah.');
            }
            return redirect()->route('users.index')->with('error', 'Admin tidak diizinkan mengedit data owner!');
        }
        // Untuk admin, update data seperti biasa
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id_users . ',id_users',
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $before = $user->toArray();
        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path($user->foto))) {
                unlink(public_path($user->foto));
            }
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/users'), $namaFile);
            $validated['foto'] = 'image/users/' . $namaFile;
        }
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        // Audit log untuk update admin
        AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'update_admin',
            'target_table' => 'users',
            'target_id' => $user->id_users,
            'before' => json_encode($before),
            'after' => json_encode($user->toArray()),
        ]);
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_users)
    {
        $user = User::findOrFail($id_users);
        if ($user->role === 'umkm_owner') {
            return redirect()->route('users.index')->with('error', 'Admin tidak diizinkan menghapus akun owner!');
        }
        $before = $user->toArray();
        $user->delete();
        // Audit log untuk hapus admin
        AuditLog::create([
            'id_users' => auth()->id(),
            'action' => 'delete_admin',
            'target_table' => 'users',
            'target_id' => $user->id_users,
            'before' => json_encode($before),
            'after' => null,
        ]);
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
