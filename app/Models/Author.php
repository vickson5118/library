<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin
 */
class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'about',
        'picture',
    ];


    /**
     * The books that belong to the Author
     *
     * @return BelongsToMany
     */
    public function books(): BelongsToMany {
        return $this->belongsToMany(Book::class, 'books_authors');
    }
}
