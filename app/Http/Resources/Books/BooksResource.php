<?php

namespace App\Http\Resources\Books;

use App\Http\Resources\Authors\AuthorsRelationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class BooksResource extends JsonResource
{
    #[ArrayShape([
        'id' => "mixed",
        'name' => "mixed",
        'description' => "mixed",
        'created_at' => "mixed",
        'authors' => AnonymousResourceCollection::class])
    ]
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'created_at'  => $this->created_at,
            'authors'     => AuthorsRelationResource::collection($this->authors),
        ];
    }
}
