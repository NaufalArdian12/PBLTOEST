<?php

namespace app\Http\Controllers\Auth;

use app\Models\StudentModels;
use app\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use app\Http\Requests\SignUpRequest;
use app\Http\Requests\SignInRequest;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        return redirect('/mahasiswa/dashboard')->with('success', 'Akun berhasil dibuat');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(SignInRequest $request)
    {
        // Ambil data input
        $identity = $request->input('NIM'); // bisa berisi NIM atau email
        $password = $request->input('password');

        $user = null;

        if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            // Login via email
            $user = UserModels::where('email', $identity)->first();
        } else {
            // Login via NIM → ambil student lalu user-nya
            $student = StudentModels::where('NIM', $identity)->first();
            $user = $student?->user; // null safe
        }

        // Cek apakah user ada dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);

            // Cek role user dan redirect sesuai peran
            return match ($user->role) {
                'admin' => redirect()->route('dashboard'), // admin
                'student' => redirect()->route('dashboard'), // mahasiswa
                default => redirect()->route('dashboard'), // fallback
            };
        }

        // Jika login gagal
        return back()->withErrors([
            'NIM' => 'NIM/email atau password salah.',
        ])->withInput();
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if (Auth::user()->role === 'Admin') {
                return view('admin.dashboard.index');
            } elseif (Auth::user()->role === 'Student') {
                return view('mahasiswa.dashboard');
            }
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

