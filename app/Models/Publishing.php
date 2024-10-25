<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperPublishing
 */
class Publishing extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    /**
     * Get the book associated with the Editor
     *
     * @return HasOne
     */
    public function book(): HasOne {
        return $this->hasOne(Book::class);
    }
}
