<?php

namespace App\UseCases\Auth;

use App\Models\User;

class AuthService
{
    public static function create(array $request): array
    {
        $user = User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
            'is_admin' => $request['is_admin']
        ]);

        $token = $user->createToken(TokenService::generate())->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public static function findOneByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
