<?php

namespace App\Rules\Order;

use App\Models\Order\OrderStatus;
use Illuminate\Contracts\Validation\Rule;

class DeliveredValidate implements Rule
{
    public function passes($attribute, $value): bool
    {
        return $value === OrderStatus::Delivered->name;
    }

    public function message(): string
    {
        return 'Status is not correctly.';
    }
}
