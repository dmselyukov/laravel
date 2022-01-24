<?php

namespace App\Http\Requests\Author;

use App\Models\Book\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['name' => "string", 'description' => "string"])]
    public function rules(): array
    {
        $rules = [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ];

       if ($this->books) {
            $rules['books.*.id'] = ['integer', Rule::in(Book::getAllBooksIds())];
        }

        return $rules;
    }
}
