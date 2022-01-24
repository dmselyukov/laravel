<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequest;
use App\Http\Resources\Books\BooksResource;
use App\Models\Book\Book;
use App\UseCases\Books\BookService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class BooksController extends Controller
{
    public function index(Request $request, Book $books): AnonymousResourceCollection
    {
        $bookObjects = BookService::search($request, $books);

        return BooksResource::collection($bookObjects);
    }

    public function store(BookRequest $request): BooksResource
    {
        $author = BookService::create($request->validated());

        return new BooksResource($author);
    }

    #[Pure]
    public function show(Book $book): BooksResource
    {
        return new BooksResource($book);
    }

    public function update(BookRequest $request, Book $book): BooksResource
    {
        $bookObject = BookService::update($request->validated(), $book);

        return new BooksResource($bookObject);
    }

    public function destroy(Book $book): \Illuminate\Http\Response|Application|ResponseFactory
    {
        $book->authors()->detach();
        $book->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
