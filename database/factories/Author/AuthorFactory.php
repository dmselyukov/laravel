<?php

namespace Database\Factories\Author;

use App\Models\Author\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    #[ArrayShape(['name' => "string", 'description' => "string"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
