<?php

namespace App\Http\Controllers;

use App\Models\Publishing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PublishingController extends Controller {

    public function index(){
        Gate::authorize('all',Publishing::class);
        return view('publishings.index',[
            'publishings' => Publishing::all()
        ]);
    }
    
    public function store(Request $request){

        Gate::authorize('all',Publishing::class);
        
        $validated = $request->validate([
            'title' => ['required','min:3','max:80','unique:publishings,title'],
        ]);

        $editor = Publishing::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($editor);    

    }

    public function update(Request $request){

    Gate::authorize('all',Publishing::class);

        $validated = $request->validate([
            'title' => ['required','min:3','max:80',Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $publishing = Publishing::find($request->input('id'));

        $publishing->title = ucfirst($validated['title']);
        $publishing->save();

        return json_encode(['success' => 'true']); 

    }


    public function delete(Request $request){
        Gate::authorize('all',Publishing::class);
        Publishing::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']); 
    }
}
