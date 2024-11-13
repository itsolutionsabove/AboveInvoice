<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return response()->json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        $user = $this->findOrCreateUser($socialUser, $provider);

        // Create token for the user (API token)
        $token = $user->createToken('app_auth')->plainTextToken;

        return ResponseService::jsonData([
            "user" => new UserResource($user),
            "token" => $token
        ]);
        // return response()->json(['token' => $token, 'user' => $user]);
    }

    private function findOrCreateUser($socialUser, $provider)
    {
        $authUser = User::where('provider_id', $socialUser->getId())->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(8)), // Generates a random password and hashes it
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ]);
    }
}


?>