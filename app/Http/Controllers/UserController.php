<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get($id){
        $user = User::find($id);
        return $user;
    }
    public function createUser($request){
        $user = new User();

        $user->username = $request['username'];
        $user->password = bcrypt($request['password']);
        $user->email = $request['email'];

        $user->save();
    }
    public function update($id){
        $user = User::find($id);

    }
}
