<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $registeredUser = UserModels::where("google_id", $socialUser->id)->first();

        if (!$registeredUser) {
            $user = UserModels::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            // Cek apakah email sudah terverifikasi
            if (!$user->hasVerifiedEmail()) {
                return redirect('/verify-email');  // Arahkan ke halaman verifikasi
            }

            Auth::login($user);
        } else {
            Auth::login($registeredUser);

            // Cek apakah email sudah terverifikasi
            if (!$registeredUser->hasVerifiedEmail()) {
                return redirect('/verify-email');  // Arahkan ke halaman verifikasi
            }
        }

        return redirect('mahasiswa/dashboard');
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
