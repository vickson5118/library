<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property string $name
 * @property string $about
 * @property string|null $picture
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Book> $books
 * @property-read int|null $books_count
 * @method static \Database\Factories\AuthorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePicture($value)
 */
	class Author extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property string $title
 * @property string|null $publication
 * @property string $summary
 * @property int $page
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $category_id
 * @property int $language_id
 * @property int $publishing_id
 * @property string $cover
 * @property string $slug
 * @property int $borrow
 * @property string|null $pdf
 * @property-read \App\Models\BookAuthor $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Author> $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Borrow> $borrows
 * @property-read int|null $borrows_count
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\Publishing $publishing
 * @method static \Database\Factories\BookFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBorrow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublishingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 */
	class Book extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $author_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereUpdatedAt($value)
 */
	class BookAuthor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property string|null $back
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUserId($value)
 */
	class Borrow extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property string $title
 * @property-read \App\Models\Book|null $book
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property string $title
 * @property-read \App\Models\Book|null $book
 * @method static \Database\Factories\LanguageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereTitle($value)
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin 
 * @property int $id
 * @property string $title
 * @property-read \App\Models\Book|null $book
 * @method static \Database\Factories\PublishingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Publishing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publishing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publishing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Publishing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publishing whereTitle($value)
 */
	class Publishing extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Borrow> $borrows
 * @property-read int|null $borrows_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

