<?php

namespace Database\Factories\AuthorBook;

use App\Models\AuthorBook\AuthorBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorBookFactory extends Factory
{
    protected $model = AuthorBook::class;

    public function definition(): array
    {
        return [
            'author_id' => $this->faker->numberBetween(1,16),
            'book_id' => $this->faker->numberBetween(1,8),
        ];
    }
}
