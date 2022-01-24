<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class BooksRelationResource extends JsonResource
{
    #[ArrayShape(['id' => "integer", 'name' => "string"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
