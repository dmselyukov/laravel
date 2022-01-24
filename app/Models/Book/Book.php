<?php

namespace App\Models\Book;

use App\Models\Author\Author;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'description'
    ];

    public static function getAllBooksIds(): array
    {
        $items = self::all(['id'])->map(function($item) {
            return $item->toArray()['id'];
        });

        return $items->toArray();
    }

    public function getCreatedAtAttribute(string $value): string
    {
        return $value;
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
