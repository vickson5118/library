<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFormValidation;
use App\Http\Requests\SearchValidation;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Language;
use App\Models\Publishing;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookController extends Controller
{

    public function index(SearchValidation $request): View
    {

        /**
         * S'il n'y as pas de recherche alors afficher la liste des tous les livres avec une pagination
         *
         */
        if ($request->input('title') == null && $request->input('author') == null && $request->input('category') == null) {

            $query = Book::query()->paginate(28);

        } elseif ($request->input('author') == null) {
            $query = Book::query();

            if ($request->validated('title')) {
                $query = $query->where('title', 'like', "%{$request->validated('title')}%");
            }

            if ($request->validated('category')) {
                $query = $query->where('category_id', '=', $request->validated('category'));
            }

            $query = $query->get();

        } else {

            $query = BookAuthor::join('authors', 'authors.id', '=', 'books_authors.author_id')
                ->join('books', 'books.id', '=', 'books_authors.book_id');

            if ($request->validated('author')) {
                $query = $query->where('books_authors.author_id', '=', $request->validated('author'));
            }

            if ($request->validated('category')) {
                $query = $query->where('category_id', '=', $request->validated('category'));
            }

            if ($request->validated('title')) {
                $query = $query->where('title', 'like', "%{$request->validated('title')}%");
            }

            $query = $query->get();

        }


        return view('welcome', [
            'books' => $query,
            'count' => $query->count(),
            'authors' => Author::get(['id', 'name']),
            'categories' => Category::all(),
            'input' => $request->validated()
        ]);
    }

    public function create(): View
    {

        if (Auth::user()->cannot('create', Book::class)) {
            abort(403);
        }

        return view('books.create', [
            'book' => new Book(),
            'publishings' => Publishing::all(),
            'authors' => Author::get(['id', 'name']),
            'categories' => Category::all(),
            'languages' => Language::all(),
        ]);
    }

    public function store(BookFormValidation $request): RedirectResponse
    {

        if (Auth::user()->cannot('create', Book::class)) {
            abort(403);
        }

        $validated = $request->validated();

        $book = Book::create([
            'title' => ucfirst($validated['title']),
            'publication' => $validated['publication'],
            'summary' => ucfirst($validated['summary']),
            'page' => $validated['page'],
            'category_id' => $validated['category'],
            'language_id' => $validated['language'],
            'publishing_id' => $validated['publishing'],
            'cover' => $request->file('cover')->store('books', 'public'),
            'slug' => $this->getBookSlug($validated['title'])
        ]);

        $book->authors()->sync($validated['author']);

        return to_route('app.index', [
            'books' => Book::query()->paginate(28),
            'authors' => Author::get(['id', 'name']),
            'categories' => Category::all()
        ]);
    }

    public function show(Book $book): View
    {

        $borrow = null;
        if ($book->borrow) {
            $borrow = Borrow::where('user_id', '=', Auth::id())
                ->where('book_id', '=', $book->id)
                ->where('back', '=', value: null)->get()->last();
        }

        return view('books.show', [
            'book' => $book,
            'borrow' => $borrow,
            'borrows' => $book->borrows,
        ]);
    }

    public function edit(Book $book): View
    {

        if (Auth::user()->cannot('update', $book)) {
            abort(403);
        }

        return view('books.edit', [
            'book' => $book,
            'publishings' => Publishing::all(),
            'authors' => Author::get(['id', 'name']),
            'categories' => Category::all(),
            'languages' => Language::all(),
        ]);
    }


    public function update(BookFormValidation $request, Book $book): RedirectResponse
    {

        if (Auth::user()->cannot('update', $book)) {
            abort(403);
        }

        $validated = $request->validated();

        $book->title = ucfirst($validated['title']);
        $book->publication = $validated['publication'];
        $book->category_id = $validated['category'];
        $book->publishing_id = $validated['publishing'];
        $book->language_id = $validated['language'];
        $book->summary = ucfirst($validated['summary']);
        $book->page = $validated['page'];
        $book->slug = $this->getBookSlug($validated['title']);

        if (isset($validated['cover']) && $validated['cover'] != null) {
            Storage::delete($book->cover);
            $book->cover = $request->file('cover')->store('books', 'public');
        }
        $book->save();
        $book->authors()->sync($validated['author']);

        return to_route('book.show', [
            'book' => $book,
            'borrows' => $book->borrows
        ]);
    }


    /** Fonction lors de l'emprunt d'un livre */
    public function borrow(Book $book): RedirectResponse
    {

        $book->borrow = true;
        $book->save();

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        return to_route('book.show', ['book' => $book]);
    }

    /** Fonction lors de le retour d'un livre
     * @throws AuthorizationException
     */
    public function back(Book $book): RedirectResponse
    {

        //mettre le boolean d'emprunt à false
        $book->borrow = false;

        //Definir la date de retour sur le livre dans la table Borrow
        $lastbookBorrow = $book->borrows->last();

        Gate::authorize('back', [$book, $lastbookBorrow]);

        $lastbookBorrow->back = date("Y-m-d");

        $book->save();
        $lastbookBorrow->save();

        return to_route('book.show', ['book' => $book]);
    }

    /**
     * Liste des livres empruntés
     */
    public function borrowIndex(): View
    {

        $borrows = Book::where('borrow', '=', true)->paginate(28);

        return view('books.borrow', [
            'borrows' => $borrows,
            'count' => $borrows->count(),
        ]);
    }

    private function getBookSlug($title): string
    {
        return Str::slug($title);
    }

    public static function initialName($nom): string
    {
        $initial = null;
        $new_mot = explode(" ", $nom);
        foreach ($new_mot as $nom) {
            $initial .= $nom[0] . '';
        }
        return strtoupper(substr($initial, 0, 2));
    }
}
