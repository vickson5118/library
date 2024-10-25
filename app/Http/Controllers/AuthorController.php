<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index() : View{

        Gate::authorize('all',Author::class);

        return view('authors.index', [
            'authors' => Author::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(Request $request): false|string
    {

        Gate::authorize('all',Author::class);
        $validated = $request->validate([
            'name' => ['required', 'unique:authors,name', 'min:3', 'max:120'],
            'about' => ['required', 'min:20'],
            'picture' => ['nullable', 'image']
        ]);

        $picturePath = null;

        if ($request->file('picture') != null) {
            $picturePath = $request->file('picture')->store('authors', 'public');
        }

        $author = Author::create([
            'name' => ucwords($validated['name']),
            'about' => ucfirst($validated['about']),
            'picture' => $picturePath
        ]);

        return json_encode($author);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(Request $request): false|string
    {

        Gate::authorize('all',Author::class);

        $validated = $request->validate([
            'edit-name' => ['required', 'min:3', 'max:120',Rule::unique('authors','name')->ignore($request->input('id'))],
            'edit-about' => ['required', 'min:20'],
            'edit-picture' => ['nullable', 'image']
        ]);

        $author = Author::find($request->input('id'));

        $author->name = $validated['edit-name'];
        $author->about = $validated['edit-about'];

        if (isset($validated['edit-picture']) && $validated['edit-picture'] != null) {
            Storage::delete($author->picture);
            $author->picture = $request->file('edit-picture')->store('authors', 'public');
        }

        $author->save();

        return json_encode(['success' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Request $request): false|string {

        Gate::authorize('all',Author::class);

        $author = Author::find($request->input('id'));

        if ($author->picture != null) {
            Storage::delete($author->picture);
        }

        $author->delete();
        return json_encode(['success' => 'true']);
    }
}
