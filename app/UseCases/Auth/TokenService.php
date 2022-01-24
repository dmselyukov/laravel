<?php

namespace App\UseCases\Auth;

class TokenService
{
    public const SIMPLE_TOKEN = 'myapptoken';

    public static function generate(): string
    {
        return self::SIMPLE_TOKEN;
    }
}
