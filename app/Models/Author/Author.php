<?php

namespace App\Models\Author;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'description'
    ];

    public function getCreatedAtAttribute(string $value): string
    {
        return $value;
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public static function getAllAuthorsIds(): array
    {
        $items = self::all(['id'])->map(function($item) {
            return $item->toArray()['id'];
        });

        return $items->toArray();
    }
}
