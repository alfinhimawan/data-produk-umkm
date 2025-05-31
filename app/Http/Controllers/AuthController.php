<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if ($user) {
            if ($user->status === 'nonaktif') {
                return back()->with('error', 'Akun Anda nonaktif. Silakan hubungi admin.')->withInput();
            }
            if (\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
                \Illuminate\Support\Facades\Auth::login($user);
                $role = $user->role === 'admin' ? 'Admin' : ($user->role === 'umkm_owner' ? 'Owner' : $user->role);
                $successMsg = 'Login berhasil! Selamat datang ' . $user->name . ' (login sebagai ' . $role . ')';
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard')->with('success', $successMsg);
                } elseif ($user->role === 'umkm_owner') {
                    $hasProfile = \App\Models\UMKMProfile::where('id_users', $user->id_users)->exists();
                    if (!$hasProfile) {
                        return redirect()->route('owner.umkm-profile')->with(['warning' => 'Silakan lengkapi profil UMKM Anda terlebih dahulu.']);
                    }
                    return redirect()->route('owner.dashboard')->with('success', $successMsg);
                } else {
                    \Illuminate\Support\Facades\Auth::logout();
                    return back()->with('error', 'Role tidak dikenali.')->withInput();
                }
            } else {
                return back()->with('error', 'Password salah.')->withInput();
            }
        }
        return back()->with('error', 'Email tidak ditemukan.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
