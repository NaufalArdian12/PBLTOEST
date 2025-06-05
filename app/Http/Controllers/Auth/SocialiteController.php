<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])  // Menambahkan parameter 'prompt' untuk memilih akun
            ->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        // Cek apakah user dengan google_id sudah ada
        $registeredUser = UserModels::where("google_id", $socialUser->id)->first();

        if (!$registeredUser) {
            // Jika belum ada, periksa apakah email sudah terdaftar di database
            $existingUser = UserModels::where('email', $socialUser->email)->first();

            if ($existingUser) {
                // Jika ada, update data yang diperlukan
                $user = $existingUser;
                $user->google_id = $socialUser->id;
                $user->google_token = $socialUser->token;
                $user->google_refresh_token = $socialUser->refreshToken;
                $user->save();
            } else {
                // Jika belum ada, buat user baru
                $user = UserModels::create([
                    'google_id' => $socialUser->id,
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
            }

            // Cek apakah email sudah terverifikasi
            if (!$user->hasVerifiedEmail()) {
                return redirect('/verify-email');  // Arahkan ke halaman verifikasi
            }

            Auth::login($user);
        } else {
            // Jika user sudah terdaftar, login user tersebut
            Auth::login($registeredUser);

            // Cek apakah email sudah terverifikasi
            if (!$registeredUser->hasVerifiedEmail()) {
                return redirect('/verify-email');  // Arahkan ke halaman verifikasi
            }
        }

        // Redirect ke dashboard berdasarkan role
        if (Auth::user()->role->name === 'Admin') {
            return redirect()->route('dashboard'); // admin dapat dashboard
        } elseif (Auth::user()->role->name === 'Student') {
            return redirect()->route('dashboard'); // mahasiswa juga dapat dashboard
        } else {
            abort(403, 'Unauthorized role.');
        }

    }

    /**
     * Handle an incoming logout request from the application.
     *
     * This method will invalidate the user's session, regenerate their CSRF
     * token, and remove any authentication information from the session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout dari aplikasi Laravel
        Auth::logout();

        // Invalidasi sesi pengguna
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk mencegah serangan CSRF
        $request->session()->regenerateToken();

        // Menghapus sesi yang terkait dengan Google OAuth
        session()->forget('google_token');
        session()->forget('google_refresh_token');

        // Atau jika menggunakan session lain untuk menyimpan data OAuth
        session()->forget('socialite_google'); // Hapus sesi yang terkait jika Anda menyimpannya

        // Redirect ke halaman login
        return redirect('/login');
    }
}
