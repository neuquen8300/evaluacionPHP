<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Login;
use Tymon\JWTAuth\Exceptions\JWTExceptions;
use Symfony\Component\HttpFoundation\Cookie;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = false;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // Metodo de login: Si es posible la autenticación de las credenciales enviadas,
    // Se obtiene una cookie a través del método getCookie() con el token correspondiente.
    
    public function login(Login $request){
      
        $validatedCredentials = $request->validated();
        $credentials = [ 
            'password' => $validatedCredentials['password']
        ];

        // Se busca el user dependiendo del tipo de input, si es email o username.
        (filter_var($validatedCredentials['username'], FILTER_VALIDATE_EMAIL)) 
            ? $credentials['email'] = $validatedCredentials['username']
            : $credentials['username'] = $validatedCredentials['username'];

        $attempt = auth('api')->attempt($credentials);

        
        if($attempt){
            return $this->loginSuccess($attempt);
        } else {
            return $this->loginFailed("Datos inválidos.");
        }
    }
    // Devuelve una cookie httpOnly con el token.
    private function loginSuccess($attempt){
        return response()->json([
            'status' => 'logged',
            'access_token' => $attempt
        ], 200)->withCookie(env('JWT_COOKIE_NAME'), 
        $attempt, 
        120,
        null,
        null,
        true,
        true);
    }
    // Devuelve un error y 401.
    private function loginFailed(string $msg){
        return response()->json([
            'error' =>  $msg
        ], 401);
    }
   
    public function logout(){
        try{
            auth()->logout();
            $cookie = \Cookie::forget(env('JWT_COOKIE_NAME'));
            return response()->json(['status' => 'Logged out'], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ], 500);
        }
    }
/*
    private function getCookie( $attempt){
        $cookie = new Cookie(
            
        
        return $cookie;
    }
*/
}
