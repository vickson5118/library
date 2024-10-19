<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperBookAuthor
 */
class BookAuthor extends Pivot{
    use HasFactory;

    protected $table = 'books_authors';
}
