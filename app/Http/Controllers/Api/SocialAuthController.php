<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Laravel\Socialite\Two\User as SocialiteUser;

class SocialAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = $this->getSocialiteUser();
        } catch (\Throwable $e) {
            Log::error('Google OAuth callback failed', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')->withErrors([
                'google' => 'Falha na autenticação com o Google. Tente novamente.',
            ]);
        }

        $user  = $this->findOrCreateUser($googleUser);
        $isNew = $user->wasRecentlyCreated;
        $token = $this->issueToken($user);

        return redirect()->to(
            $isNew
                ? route('onboarding', ['token' => $token])
                : route('dashboard', ['token' => $token])
        );
    }

    private function getSocialiteUser(): SocialiteUser
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');

        if (app()->environment('local')) {
            $driver->setHttpClient(new Client([
                'verify' => 'C:\php\ssl\cacert.pem',
            ]));
        }

        return $driver->user();
    }

    private function findOrCreateUser(SocialiteUser $googleUser): User
    {
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            $this->syncGoogleId($user, $googleUser->getId());
            return $user;
        }

        return User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'avatar'    => $googleUser->getAvatar(),
            'google_id' => $googleUser->getId(),
            'password'  => Hash::make(Str::random(32)),
        ]);
    }

    private function syncGoogleId(User $user, string $googleId): void
    {
        if ($user->google_id) {
            return;
        }

        $user->updateQuietly(['google_id' => $googleId]);
    }

    private function issueToken(User $user): string
    {
        $user->tokens()->delete();

        return $user->createToken('google_auth')->plainTextToken;
    }
}