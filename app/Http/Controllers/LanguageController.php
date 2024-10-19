<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class LanguageController extends Controller
{

    public function index()
    {
        Gate::authorize('all',Language::class);
        return view('languages.index', [
            'languages' => Language::all()
        ]);
    }


    public function store(Request $request){
        Gate::authorize('all',Language::class);
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:20', 'unique:languages,title'],
        ]);

        $language = Language::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($language);
    }

    public function update(Request $request)
    {

        Gate::authorize('all',Language::class);
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'max:20', Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $language = Language::find($request->input('id'));

        $language->title = ucfirst($validated['title']);
        $language->save();

        return json_encode(['success' => 'true']);
    }


    public function delete(Request $request){
        Gate::authorize('all',Language::class);
        Language::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']);
    }
}
