<?php

namespace App\Http\Requests\Book;

use App\Models\Author\Author;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class BookRequest extends FormRequest
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

        if ($this->authors) {
            $rules['authors.*.id'] = ['integer', Rule::in(Author::getAllAuthorsIds())];
        }

        return $rules;

    }
}
