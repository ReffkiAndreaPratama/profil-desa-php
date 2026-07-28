<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVerifiedEmail
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('admin.login')->withErrors(['email' => 'Silakan verifikasi email Anda terlebih dahulu.']);
        }

        return $next($request);
    }
}
