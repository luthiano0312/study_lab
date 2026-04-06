<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return redirect($url);
    }

    public function callback()
    {
        \Log::info('Google callback chamado', ['query' => request()->all()]);

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            \Log::info('Google user ok', ['email' => $googleUser->getEmail()]);
        } catch (\Exception $e) {
            \Log::error('Erro Socialite callback: ' . $e->getMessage());
            return redirect('/login?error=google_auth_failed');
        }

        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        $user->tokens()->delete();
        $token = $user->createToken('google_auth')->plainTextToken;

        return redirect('/dashboard?token=' . $token);
    }
}
