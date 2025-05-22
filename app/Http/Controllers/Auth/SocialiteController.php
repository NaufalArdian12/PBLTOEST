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
        return Socialite::driver('google')->redirect();
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

        return redirect('/dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
