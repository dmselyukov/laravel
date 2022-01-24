<?php

namespace App\Http\Requests\Order;

use App\Models\Book\Book;
use App\Rules\Order\IsExistOrderValidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape([
        'user'           => "string",
        'user.*.name'    => "string",
        'user.*.email'   => "string",
        'user.*.address' => "string",
        'books'          => "string",
        'books.*.id'     => "string",
        'books.*.name'   => "string"
    ])]
    public function rules(): array
    {
        return [
            'user'                => 'required|array',
            'user.*.name'         => 'required|string',
        //    'user.*.phone_number' => ['required', new PhoneValidate()],
            'user.*.email'        => 'required|email',
            'user.*.address'      => 'required|string',
            'books'               => 'required|array',
            'books.*.id'          => ['required', 'integer', Rule::in(Book::getAllBooksIds())],
            'books.*.name'        => 'required|string',
        ];
    }
}
