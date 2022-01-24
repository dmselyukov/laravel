<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'content',
        'status'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function getCreatedAtAttribute(string $value): string
    {
        return $value;
    }
}
