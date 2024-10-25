<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperBorrow
 */
class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'back'
    ];

    /**
     * Get the user associated with the Borrow
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the Borrow
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo{
        return $this->belongsTo(Book::class);
    }
}
