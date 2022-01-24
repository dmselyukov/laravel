<?php

namespace Database\Factories\Book;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class BookFactory extends Factory
{
    protected $model = Book::class;

    #[ArrayShape(['name' => "string", 'description' => "string"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
