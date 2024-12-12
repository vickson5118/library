<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];


    /**
     * Get the book associated with the Category
     *
     * @return HasOne
     */
    public function book(): HasOne {
        return $this->hasOne(Book::class);
    }
}
