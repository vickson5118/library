<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperBook
 */

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publication',
        'summary',
        'page',
        'category_id',
        'language_id',
        'publishing_id',
        'cover',
        'slug'
    ];

    /**
     * Get the category that owns the Book
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the language that owns the Book
     *
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the publishing that owns the Book
     *
     * @return BelongsTo
     */
    public function publishing(): BelongsTo
    {
        return $this->belongsTo(Publishing::class);
    }

    /**
     * The authors that belong to the Book
     *
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany{
        return $this->belongsToMany(Author::class, 'books_authors')->using(BookAuthor::class);
    }

    /**
     * Get all of the borrows for the Book
     *
     * @return HasMany
     */
    public function borrows(): HasMany {
        return $this->hasMany(Borrow::class);
    }
}
