<?php

namespace App\Rules\Order;

use App\UseCases\ExternalApi\PhoneVerification\Api;
use Illuminate\Contracts\Validation\Rule;

class PhoneValidate implements Rule
{
    public function __construct(private Api $api = new Api())
    {

    }

    public function passes($attribute, $value): bool
    {
        return $this->api->validate($value);
    }

    public function message(): string
    {
        return 'Phone number is not correctly.';
    }
}
