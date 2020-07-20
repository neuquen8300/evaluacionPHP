<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthCheck;
use JWTAuth;
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
    public function update(UpdateUser $request){

        $updatedUser = $request->validated();

        $user = User::where('email', $updatedUser->email);
        
        $user->sexo = $updatedUser['sexo'];
        $user->altura = $updatedUser['altura'];
        $user->peso = $updatedUser['peso'];
        $user->fechaNac = $updatedUser['fechaNac'];

        $user->save();

    }
    public function isAuthenticated(AuthCheck $request){
        $auth = auth()->user();
        if ($request->cookie(env('JWT_COOKIE_NAME')) && $auth){
        return response()->json([
                'email' => $auth->email,
                'username' => $auth->username], 200);
        } else {
            return response()->json([
                'error' => 'Sin autenticar.'
            ], 401);
        }
    }
}
