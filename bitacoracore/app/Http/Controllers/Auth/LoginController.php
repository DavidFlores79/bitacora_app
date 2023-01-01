<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\BitacoraTrait;
use App\Traits\OSNotificationTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers, BitacoraTrait, OSNotificationTrait;

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

    public function username()
    {
        $loginData = request()->input('login');
        $fieldName = filter_var($loginData, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        request()->merge([$fieldName => $loginData]);
        return $fieldName;
    }

        /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ((auth()->user()->bloqueado)) {
            $this->guardarEvento("Usuario Bloqueado", " intentó iniciar sesión pero está bloqueado ", "S/D",false); //bitacora
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $mensaje = "Su usuario está bloqueado. Favor de verificar!";
            return redirect()->route('login')->with("error", $mensaje);
        }

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        
        $perfilId = auth()->user()->perfil->id;
        $request->session()->put('perfil_id', $perfilId);
        $this->guardarEvento("Iniciar Sesion", "inicio sesion"); //bitacora
        $this->sendNotification(auth()->user()->nombre." ".auth()->user()->apellido." ha iniciado sesion desde Web 😃");

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
}
