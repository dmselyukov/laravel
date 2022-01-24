<?php

namespace App\Rules\Order;

use App\Models\Order\Order;
use Illuminate\Contracts\Validation\Rule;

class IsExistOrderValidate implements Rule
{
    public function passes($attribute, $value): bool
    {
        return Order::where('id', $value)->exists();
    }

    public function message(): string
    {
        return 'Order does not exist';
    }
}
