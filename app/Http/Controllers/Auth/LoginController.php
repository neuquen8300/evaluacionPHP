<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $credentials = $request->validated();
        if($token = Auth::attempt($credentials)){
            $cookie = $this->getCookie($token);
            return response()->json([
                'token' => $token,
                'user' => auth()->user()
            ])->withCookie($cookie);
        }
    }

    private function getCookie($token){
        return cookie(env('AUTH_COOKIE_NAME'),
            $token,
            120,
            NULL,
            NULL,
            true,
            true,
            false,
            'Strict'        
        );
    }
}
