<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Redirect ke Google untuk proses OAuth
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google setelah login
    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        // Cek apakah user sudah terdaftar berdasarkan google_id
        $registeredUser = User::where('google_id', $socialUser->id)->first();

        if (!$registeredUser) {
            // Jika belum terdaftar, buat user baru
            $user = User::updateOrCreate(
                ['google_id' => $socialUser->id],
                [
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make(123), // Password random (opsional)
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]
            );

            Auth::login($user);
        } else {
            // Jika sudah terdaftar, langsung login
            Auth::login($registeredUser);
        }

        // Redirect ke halaman dashboard atau home
        return redirect('/');
    }
}
