<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LanguageController extends Controller
{

    /**
     * @throws AuthorizationException
     */
    public function index() : View {
        Gate::authorize('all',Language::class);
        return view('languages.index', [
            'languages' => Language::all()
        ]);
    }


    /**
     * @throws AuthorizationException
     */
    public function store(Request $request) : string {
        Gate::authorize('all',Language::class);
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:20', 'unique:languages,title'],
        ]);

        $language = Language::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($language);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request) : string{

        Gate::authorize('all',Language::class);
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:20', Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $language = Language::find($request->input('id'));

        $language->title = ucfirst($validated['title']);
        $language->save();

        return json_encode(['success' => 'true']);
    }


    /**
     * @throws AuthorizationException
     */
    public function delete(Request $request) : string{
        Gate::authorize('all',Language::class);
        Language::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']);
    }
}
