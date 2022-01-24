<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class OrdersResource extends JsonResource
{
    #[ArrayShape(['id' => "mixed", 'content' => "mixed", 'status' => "mixed", 'created_at' => "mixed"])]
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'content'     => $this->content,
            'status'      => $this->status,
            'created_at'  => $this->created_at,
        ];
    }
}
