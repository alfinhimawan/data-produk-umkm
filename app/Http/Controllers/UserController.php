<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required|in:admin,umkm_owner',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFile = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('image/users'), $namaFile);
            $validated['foto'] = 'image/users/' . $namaFile;
        }
        if ($validated['role'] === 'admin') {
            $validated['status'] = 'aktif';
        } elseif (!isset($validated['status'])) {
            $validated['status'] = 'aktif';
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
        if (auth()->user()->role === 'admin' && auth()->user()->id_users != $user->id_users) {
            return redirect()->route('users.index')->with('error', 'Anda hanya bisa mengedit akun Anda sendiri.');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_users)
    {
        $user = User::findOrFail($id_users);
        if (auth()->user()->role === 'admin' && auth()->user()->id_users != $user->id_users) {
            return redirect()->route('users.index')->with('error', 'Anda hanya bisa mengedit akun Anda sendiri.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id_users . ',id_users',
            'password' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $validated['role'] = $user->role;
        $validated['status'] = $user->status;
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
        if ($validated['role'] === 'admin') {
            $validated['status'] = 'aktif';
        } elseif (!isset($validated['status'])) {
            $validated['status'] = 'aktif';
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_users)
    {
        $user = User::findOrFail($id_users);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
