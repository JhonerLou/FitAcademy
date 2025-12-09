<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class OtpController extends Controller
{
    public function create(Request $request): View
    {
        $email = session('email');

        if (!$email) {
            return view('auth.register')->withErrors(['email' => 'Session expired. Please register again.']);
        }

        return view('auth.verify-otp', ['email' => $email]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
            'email' => 'required|email',
        ]);
        $key = 'registration_' . $request->email;
        $data = Cache::get($key);
        if (!$data) {
            return redirect()->route('register')->withErrors(['email' => 'Verification timed out. Please register again.']);
        }

        if ($request->otp != $data['otp']) {
            return back()->withInput()->withErrors(['otp' => 'The provided code is incorrect.']);
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
            'email_verified_at' => now(),
        ]);
        Cache::forget($key);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Account created and verified successfully!');
    }


    public function resend(Request $request): RedirectResponse
    {
       $email = $request->input('email');
        $key = 'registration_' . $email;
        $data = Cache::get($key);

        if (!$data) {
            return redirect()->route('register')->withErrors(['email' => 'Session expired. Please register again.']);
        }

        $newOtp = rand(100000, 999999);
        $data['otp'] = $newOtp;

        Cache::put($key, $data, 600);
        Mail::to($email)->send(new OtpMail($newOtp));
        return back()->with('success', 'A new code has been sent to your email.');
    }
}
