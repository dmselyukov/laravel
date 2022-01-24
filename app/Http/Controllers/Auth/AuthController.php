<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\AuthService;
use App\UseCases\Auth\TokenService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use function response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\Response|Application|ResponseFactory
    {
        $user = AuthService::create($request->validated());

        return response($user,Response::HTTP_CREATED);
    }

    public function login(Request $request): \Illuminate\Http\Response|Application|ResponseFactory
    {
        $user = AuthService::findOneByEmail($request->email);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken(TokenService::generate())->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_OK);
    }
}
