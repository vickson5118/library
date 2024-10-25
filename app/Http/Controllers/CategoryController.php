<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategoryController extends Controller {

    /**
     * @throws AuthorizationException
     */
    public function index() : View{
        Gate::authorize('all',Category::class);
        return view('categories.index',[
            'categories' => Category::all()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request) : string {
        Gate::authorize('all',Category::class);
        $validated = $request->validate([
            'title' => ['required','min:3','max:30','unique:categories,title'],
        ]);

        $category = Category::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($category);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request) : string {
        Gate::authorize('all',Category::class);

        $validated = $request->validate([
            'title' => ['required','min:3','max:30',Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $category = Category::find($request->input('id'));

        $category->title = ucfirst($validated['title']);
        $category->save();

        return json_encode(['success' => 'true']);

    }


    /**
     * @throws AuthorizationException
     */
    public function delete(Request $request) : string {
        Gate::authorize('all',Category::class);
        Category::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']);
    }
}
