<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UMKMProfile;

class EnsureUMKMProfileExists
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 'umkm_owner') {
            $hasProfile = UMKMProfile::where('id_users', $user->id_users)->exists();
            // Allow access to only their own profile page
            if (!$hasProfile && !$request->routeIs('owner.umkm-profile') && !$request->is('owner/umkm-profile')) {
                return redirect()->route('owner.umkm-profile')->with('warning', 'Silakan lengkapi profil UMKM Anda terlebih dahulu.');
            }
        }
        return $next($request);
    }
}
