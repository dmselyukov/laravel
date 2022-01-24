<?php

namespace Database\Seeders;

use App\Models\Book\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(10)->create()->each(function ($book) {
            $book->save();
        });
    }
}
