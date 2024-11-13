<?php

namespace App\Services;

use App\Services\Response\ResponseService;
use Firebase\JWT\SignatureInvalidException;
use Google_Client;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GoogleAuthService
{

    private ?string $client_id = null, $client_secret = null;
    private array $userData = [];

    public function __construct()
    {
        $this->client_id = env('GOOGLE_CLIENT_ID', "");
        $this->client_secret = env('GOOGLE_CLIENT_SECRET', "");
    }

    public function validateToken($token): GoogleAuthService
    {
        try {
            $client = new Google_Client();
            $client->setClientId($this->client_id);
            $client->setClientSecret($this->client_secret);
            if (substr_count($token, '.') !== 2)
                throw new HttpResponseException(ResponseService::jsonError($token));
            $this->userData = (array) $client->verifyIdToken($token);
        }catch (\UnexpectedValueException $e) {
            abort(401, ResponseService::jsonError($e->getMessage()));
        }
        return $this;
    }

    public function validateSub($sub): GoogleAuthService
    {
        if($this->sub != $sub) abort(401, ResponseService::jsonError('Invalid Token'));
        return $this;
    }

    public static function init(): GoogleAuthService
    {
        return new self;
    }

    public function userData(): array
    {
        return [
            'name' => $this->userData['given_name'],
            'last_name' => $this->userData['family_name'],
            'email' => $this->userData['email'],
            'password' => bcrypt(uniqid()),
            'thumb' => $this->userData['picture'] ?? null,
        ];
    }

}
