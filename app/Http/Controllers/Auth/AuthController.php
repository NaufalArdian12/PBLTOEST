<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Tampilkan form register
    public function registerForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(SignUpRequest $request)
    {
        // Data sudah tervalidasi pada saat request diterima
        $user = UserModels::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Akun berhasil dibuat');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        // Jika pengguna sudah login, arahkan mereka ke dashboard atau halaman lain
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('auth.login');
    }


    // Proses login
    public function login(SignInRequest $request)
    {
        // Data sudah tervalidasi pada saat request diterima
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect ke halaman yang dimaksud setelah login
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

