<?php

namespace App\Http\Requests\Order;

use App\Rules\Order\IsExistOrderValidate;
use App\Rules\Order\ProcessedValidate;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class ProcessedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[Pure]
    #[ArrayShape(['id' => "array", 'status' => "array"])]
    public function rules(): array
    {
        return [
            //'id'     => ['required', 'integer', new IsExistOrderValidate()],
            'status' => ['required', 'string', new ProcessedValidate()],
        ];
    }
}
