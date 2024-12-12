<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller{

    /**
     * @throws AuthorizationException
     */
    public function index() : View{
        Gate::authorize('all',User::class);
        return view('users.index',[
            'users' => User::all()
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request) : string{
        Gate::authorize('all',User::class);
        $user = User::find($request->input('id'));
        $user->admin = !$user->admin;
        $user->save();

        return json_encode(['success' => 'true']);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Request $request) : string{
        Gate::authorize('all',User::class);
        User::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']);
    }
}
