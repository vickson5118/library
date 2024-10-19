<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller {

    public function index(){
        Gate::authorize('all',Category::class);
        return view('categories.index',[
            'categories' => Category::all()
        ]);
    }
    
    public function store(Request $request){
        Gate::authorize('all',Category::class);
        $validated = $request->validate([
            'title' => ['required','min:3','max:30','unique:categories,title'],
        ]);

        $category = Category::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($category);
    }

    public function update(Request $request){
        Gate::authorize('all',Category::class);

        $validated = $request->validate([
            'title' => ['required','min:3','max:30',Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $category = Category::find($request->input('id'));

        $category->title = ucfirst($validated['title']);
        $category->save();

        return json_encode(['success' => 'true']); 

    }


    public function delete(Request $request){
        Gate::authorize('all',Category::class);
        Category::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']); 
    }
}
