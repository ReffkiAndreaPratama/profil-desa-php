<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        if ($request->fulfill()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('admin.dashboard')->with('success', 'Email berhasil diverifikasi.');
    }

    public function resend(Request $request)
    {
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
        }

        return back()->with('success', 'Link verifikasi email berhasil dikirim.');
    }
}
