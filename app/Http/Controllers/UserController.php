<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\AuthCheck;
use App\Http\Requests\UpdateUser;
use Exception;
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
    public function updateProfile(UpdateUser $request){
        $updatedUser = $request->validated();
        $auth = auth()->user();
        if ($auth) {
            try{
                $user = User::where('username', $auth->username)->orWhere('email', $auth->username)->first();
                $user->altura = $updatedUser['altura'];
                $user->peso = $updatedUser['peso'];
                $user->sexo = $updatedUser['sexo'];
                $user->ubicacion = $updatedUser['ubicacion'];
                $user->fechaNac = $updatedUser['fechaNac'];
                $user->save();
                return response()->json(['status' => 'ok'],200);
            } catch (Exception $e){
                return $e; //response()->json(['error' => $e], 500);
            }
        } else {
            return response()->json(['error' => 'Sin autenticar.'], 401);
        }
    }
  
}
