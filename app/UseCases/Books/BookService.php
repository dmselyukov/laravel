<?php

namespace App\UseCases\Books;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BookService
{
    public static function search(Request $request, Book $books): Collection|array
    {
        $booksObjects = $books->newQuery();

        if ($request->has('name')) {
            $booksObjects->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->has('description')) {
            $booksObjects->where('description','LIKE', '%' . $request->input('name') . '%');
        }

        return $booksObjects->get();
    }

    public static function create(array $request): Book
    {
        $book = new Book();
        $book->name = $request['name'];
        $book->description = $request['description'];
        $book->save();

        if (isset($request['authors']) && is_array($request['authors'])) {
            $book->authors()->attach(self::formattedAuthorIds($request['authors']));
        }

        return $book;
    }

    public static function update(array $request, Book $book): Book
    {
        $book->name = $request['name'];
        $book->description = $request['description'];
        $book->update();

        if (isset($request['authors']) && is_array($request['authors'])) {
            $book->authors()->sync(self::formattedAuthorIds($request['authors']));
        } else {
            $book->authors()->sync([]);
        }

        return $book;
    }

    public static function formattedAuthorIds(array $authors): array
    {
        foreach ($authors as $author) {
            $authorsIds[] = $author['id'];
        }

        return $authorsIds ?? [];
    }
}
