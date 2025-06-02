<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman verifikasi email
    public function show(Request $request)
    {
        if ($request->user() && $request->user()->hasVerifiedEmail()) {
            return redirect('/mahasiswa/dashboard');
        }
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/mahasiswa/dashboard');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirect to set password page
        return redirect()->route('password.set');
    }

    // Menampilkan halaman untuk mengatur password
    public function showSetPasswordForm(Request $request)
    {
        return view('auth.set-password');
    }

    // Menyimpan password yang diinput oleh pengguna
    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // pastikan password valid dan sesuai dengan aturan
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password); // Hash password sebelum disimpan
        $user->save();

        return redirect('/mahasiswa/dashboard')->with('status', 'Password has been set successfully!');
    }

    public function resend(Request $request)
    {
        $user = $request->user();
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/mahasiswadashboard')->with('message', 'Your Email is already verified!');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}

