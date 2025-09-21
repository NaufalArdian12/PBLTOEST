<?php
namespace App\Http\Controllers;

use app\Models\UserModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = UserModels::where('email', $request->email)
            ->whereNotNull('email_verified_at')
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan atau belum terverifikasi.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $resetLink = url("/reset-password/{$token}?email={$user->email}");

        Mail::send('emails.reset-password', ['resetLink' => $resetLink], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Reset Password - TOEST 2025');
        });


        return back()->with('status', 'The password reset link has been sent to your email.');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Invalid or expired token.']);
        }

        $user = UserModels::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password changed successfully. Please login again.');
    }
}
