<?php

namespace App\UseCases\ExternalApi\PhoneVerification;

use Facade\FlareClient\Http\Exceptions\BadResponse;
use Illuminate\Support\Facades\Http;

class Api
{
    private string $url;
    private string $token;

    public function __construct()
    {
        $this->url   = env('VERIFICATION_PHONE_API_URL');
        $this->token = env('VERIFICATION_PHONE_API_TOKEN');
    }

    public function validate(string $phoneNumber): bool
    {
        $query = [
            'access_key' => $this->token,
            'number'     => $phoneNumber,
        ];
        $responseApi = Http::get($this->url . '?' . http_build_query($query));
        $response = $responseApi->json();

        if (isset($response['error'])) {
            throw new BadResponse('The api returns a bad response');
        }

        return (bool)$response['valid'];
    }
}
