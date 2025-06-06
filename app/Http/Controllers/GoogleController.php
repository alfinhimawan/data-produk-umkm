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

        $user = User::where('email', $googleUser->getEmail())
            ->where('role', 'umkm_owner')
            ->first();

        if (!$user) {
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
            if ($googleUser->getAvatar()) {
                $user->foto = $googleUser->getAvatar();
                $user->save();
            }
        }

        if ($user && $user->status === 'nonaktif') {
            return redirect()->route('login')->with('error', 'Akun Anda nonaktif. Silakan hubungi admin.');
        }

        if ($user && $user->status === 'pending') {
            return redirect()->route('login')->with('info', 'Akun Anda berhasil dibuat. Silakan cek email Anda untuk verifikasi sebelum login.');
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
}
