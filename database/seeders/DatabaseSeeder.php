<?php

namespace Database\Seeders;

use App\Models\Author\Author;
use App\Models\AuthorBook\AuthorBook;
use App\Models\Book\Book;
use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
        Author::factory(16)->create();
        Book::factory(8)->create();
        AuthorBook::factory(45)->create();
        Order::factory(5)->create();
    }
}
