<?php

namespace App\Http\Controllers;

use App\Models\Publishing;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PublishingController extends Controller {

    /**
     * @throws AuthorizationException
     */
    public function index() : View{
        Gate::authorize('all',Publishing::class);
        return view('publishings.index',[
            'publishings' => Publishing::all()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Request $request) : string{

        Gate::authorize('all',Publishing::class);

        $validated = $request->validate([
            'title' => ['required','min:3','max:80','unique:publishings,title'],
        ]);

        $editor = Publishing::create([
            'title' => ucfirst($validated['title'])
        ]);

        return json_encode($editor);

    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request) : string {

    Gate::authorize('all',Publishing::class);

        $validated = $request->validate([
            'title' => ['required','min:3','max:80',Rule::unique('publishings')->ignore($request->input('id'))],
        ]);

        $publishing = Publishing::find($request->input('id'));

        $publishing->title = ucfirst($validated['title']);
        $publishing->save();

        return json_encode(['success' => 'true']);

    }


    /**
     * @throws AuthorizationException
     */
    public function delete(Request $request) : string{
        Gate::authorize('all',Publishing::class);
        Publishing::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']);
    }
}
