<?php

namespace Database\Seeders;

use App\Models\Author\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    public function run(): void
    {
        Author::factory()->count(10)->create()->each(function ($book) {
            $book->save();
        });
    }
}
