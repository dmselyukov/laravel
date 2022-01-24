<?php

namespace App\Http\Resources\Authors;

use App\Http\Resources\Books\BooksRelationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorsResource extends JsonResource
{
    #[ArrayShape([
        'id' => "mixed",
        'name' => "mixed",
        'description' => "mixed",
        'created_at' => "mixed",
        'books' => AnonymousResourceCollection::class
    ])]
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'created_at'  => $this->created_at,
            'books'       => BooksRelationResource::collection($this->books),
        ];
    }
}
