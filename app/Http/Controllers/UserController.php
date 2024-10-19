<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller{
    
    public function index(){
        Gate::authorize('all',User::class);
        return view('users.index',[
            'users' => User::all()
        ]);
    }

    public function update(Request $request){
        Gate::authorize('all',User::class);
        $user = User::find($request->input('id'));
        $user->admin = !$user->admin;
        $user->save();

        return json_encode(['success' => 'true']); 
    }

    public function delete(Request $request){
        Gate::authorize('all',User::class);
        User::find($request->input('id'))->delete();
        return json_encode(['success' => 'true']); 
    }
}
