<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function create(): View
    {
        return view('auth.verify-otp');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();

        if ($request->otp != $user->otp) {
            return back()->withErrors(['otp' => 'The provided code is incorrect.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'The code has expired. Please request a new one.']);
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'otp' => null, // Clear the OTP
            'otp_expires_at' => null,
        ])->save();

        // 4. Redirect to home or dashboard
        return redirect()->route('home')->with('success', 'Email verified successfully!');
    }


    public function resend(): RedirectResponse
    {
        $user = Auth::user();
        $user->generateOtp();

        Mail::to($user->email)->send(new OtpMail($user->otp));

        return back()->with('success', 'A new code has been sent to your email.');
    }
}
