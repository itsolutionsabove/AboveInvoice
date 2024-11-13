<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Services\Response\ResponseService;

class FirebaseAuthService
{
    private ?string $verifyUrl;
    private array $userData = [];

    public static function init(): FirebaseAuthService
    {
        return new self;
    }

    public function __construct()
    {
        $webApiKey = env('FIREBASE_API_KEY');
        $this->verifyUrl = "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key={$webApiKey}";
    }

    public function validateToken($token): FirebaseAuthService
    {

        $firebaseWebApiKey = env('FIREBASE_API_KEY');
        $firebaseVerifyUrl = "https://identitytoolkit.googleapis.com/v1/accounts:lookup?key={$firebaseWebApiKey}";

        $client = new Client();

        try {

            $response = $client->post($firebaseVerifyUrl, [
                'json' => ['idToken' => $token],
                'headers' => ['Content-Type' => 'application/json']
            ]);

            $firebaseResponse = json_decode($response->getBody(), true);

            if (is_array($firebaseResponse['users'] ?? false)) {
                $this->userData = $firebaseResponse['users'][0];
            }
        } catch (\Exception|GuzzleException $e) {
            dd($e->getMessage());
        }
        return $this;
    }

    public function userData(): array
    {
        return [
            'name' => $this->userData['displayName'] ?? '',
            'email' => $this->userData['email'] ?? '',
            'password' => bcrypt(uniqid()),
            'thumb' => $this->userData['photoUrl'] ?? null,
        ];
    }

}
