<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorRequest;
use App\Http\Resources\Authors\AuthorsResource;
use App\Models\Author\Author;
use App\UseCases\Authors\AuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

class AuthorsController extends Controller
{
    public function index(Request $request, Author $authors): AnonymousResourceCollection
    {
        $authorObjects = AuthorService::search($request, $authors);

        return AuthorsResource::collection($authorObjects);
    }

    public function store(AuthorRequest $request): AuthorsResource
    {
        $author = AuthorService::create($request->validated());

        return new AuthorsResource($author);
    }

    #[Pure]
    public function show(Author $author): AuthorsResource
    {
        return new AuthorsResource($author);
    }

    public function update(AuthorRequest $request, Author $author): AuthorsResource
    {
        $authorObject = AuthorService::update($request->validated(), $author);

        return new AuthorsResource($authorObject);
    }

    public function destroy(Author $author): \Illuminate\Http\Response|Application|ResponseFactory
    {
        $author->books()->detach();
        $author->delete();

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
