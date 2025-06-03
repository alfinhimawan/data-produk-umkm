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
            if ($user->role !== 'admin') {
                return back()->with('error', 'Login hanya untuk admin. Silakan gunakan login Google untuk Owner.')->withInput();
            }
            if (\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
                \Illuminate\Support\Facades\Auth::login($user);
                $successMsg = 'Login berhasil! Selamat datang ' . $user->name . ' (login sebagai Admin)';
                return redirect()->route('admin.dashboard')->with('success', $successMsg);
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
