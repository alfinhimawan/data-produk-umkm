<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwnerGoogleVerificationMail;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google.');
        }

        // Cari user owner (termasuk yang soft delete)
        $user = User::withTrashed()->where('email', $googleUser->getEmail())
            ->where('role', 'umkm_owner')
            ->first();

        if (!$user) {
            // Jika tidak ada, buat user baru
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Owner',
                'email' => $googleUser->getEmail(),
                'password' => '',
                'role' => 'umkm_owner',
                'status' => 'pending',
                'foto' => $googleUser->getAvatar(),
                'verification_token' => Str::random(64),
            ]);
            Mail::to($user->email)->send(new OwnerGoogleVerificationMail($user));
        } else {
            // Jika user soft delete, restore dan update data penting
            if ($user->trashed()) {
                $user->restore();
                $user->status = 'pending';
                $user->verification_token = Str::random(64);
                Mail::to($user->email)->send(new OwnerGoogleVerificationMail($user));
            }
            // Update data Google terbaru
            $user->name = $googleUser->getName() ?? $googleUser->getNickname() ?? $user->name;
            if ($googleUser->getAvatar()) {
                $user->foto = $googleUser->getAvatar();
            }
            $user->save();
        }

        if ($user && $user->status === 'nonaktif') {
            return redirect()->route('login')->with('error', 'Akun Anda nonaktif. Silakan hubungi admin.');
        }

        if ($user && $user->status === 'pending') {
            return redirect()->route('login')->with('success', 'Verification email sent to ' . $user->email);
        }

        Auth::login($user);
        $hasProfile = \App\Models\UMKMProfile::where('id_users', $user->id_users)->exists();
        if ($hasProfile) {
            return redirect()->route('owner.dashboard')->with('success', 'Login Google berhasil!');
        } else {
            return redirect()->route('owner.umkm-profile')->with('success', 'Login Google berhasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verifyEmail($token)
    {
        $user = \App\Models\User::where('verification_token', $token)->first();
        if ($user) {
            $user->status = 'aktif';
            $user->verification_token = null;
            $user->save();
            return redirect()->route('login')->with('success', 'Email berhasil diverifikasi, silakan login.');
        }
        return redirect()->route('login')->with('error', 'Token verifikasi tidak valid.');
    }

    // Login owner dengan email saja (setelah pernah login Google)
    public function loginOwnerWithEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $user = \App\Models\User::where('email', $request->email)
            ->where('role', 'umkm_owner')
            ->first();

        if ($user) {
            if ($user->status !== 'aktif') {
                return back()->with('error', 'Akun Anda belum diverifikasi atau nonaktif.')->withInput()->with('show_owner', true);
            }
            \Illuminate\Support\Facades\Auth::login($user);
            return redirect()->route('owner.dashboard')->with('success', 'Login Owner berhasil!');
        }
        return back()->with('error', 'Email tidak ditemukan atau bukan owner.')->withInput()->with('show_owner', true);
    }
}
