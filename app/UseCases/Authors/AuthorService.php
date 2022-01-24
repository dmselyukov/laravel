<?php

namespace App\UseCases\Authors;

use App\Models\Author\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AuthorService
{
    public static function create(array $request): Author
    {
        $author = new Author();
        $author->name = $request['name'];
        $author->description = $request['description'];
        $author->save();

        if (isset($request['books']) && is_array($request['books'])) {
            $author->books()->attach(self::formattedBookIds($request['books']));
        }

        return $author;
    }

    public static function update(array $request, Author $author): Author
    {
        $author->name = $request['name'];
        $author->description = $request['description'];
        $author->update();

        if (isset($request['books']) && is_array($request['books'])) {
            $author->books()->sync(self::formattedBookIds($request['books']));
        } else {
            $author->books()->sync([]);
        }

        return $author;
    }

    public static function search(Request $request, Author $authors): Collection|array
    {
        $authorsObjects = $authors->newQuery();

        if ($request->has('name')) {
            $authorsObjects->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->has('description')) {
            $authorsObjects->where('description','LIKE', '%' . $request->input('name') . '%');
        }

        return $authorsObjects->get();
    }

    public static function formattedBookIds(array $books): array
    {
        foreach ($books as $book) {
            $booksIds[] = $book['id'];
        }

        return $booksIds ?? [];
    }
}
