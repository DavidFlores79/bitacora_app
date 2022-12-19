<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\BitacoraTrait;
use App\Traits\OSNotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class AuthController extends Controller
{
    use BitacoraTrait, OSNotificationTrait;

    public function login(Request $request)
    {
        $rules = [
            'nickname' => 'required|string|min:1',
            'password' => 'required|string',
        ];

        $this->validate($request, $rules);

        $credentials = [
            'nickname' => $request->input('nickname'),
            'password' => $request->input('password'),
        ];

        try {
            if (!$jwt = JWTAuth::attempt($credentials)) {
                
                $data = [
                    'code' => 401,
                    'success' => false,
                    'message' => 'Credenciales Inválidas.',
                    'status' => 'error',
                ];
                return response()->json($data, $data['code']);
            }
        } catch (JWTException $e) {
            $data = [
                'code' => 400,
                'success' => false,
                'message' => 'No se pudo generar Token. Favor de Verificar.',
                'status' => 'error',
            ];

            return response()->json($data, $data['code']);
        }

        $user = User::where("id", auth()->user()->id)->first();
        $user->load("miPerfil", 'servicios');

        if ($user->bloqueado) {
            $this->guardarEventoApi($user, "Iniciar Sesion", "intentó iniciar sesión desde Api-Rest","S/D", false); //bitacora
            $data = [
                'code' => 401,
                'success' => false,
                'message' => 'Usuario Bloqueado.',
                'status' => 'error',
            ];
        } else {
            $this->guardarEventoApi($user, "Iniciar Sesion", "inició sesión desde Api-Rest"); //bitacora

            $payload = JWTAuth::getJWTProvider()->decode($jwt);

            $data = [
                'code' => 200,
                'status' => 'success',
                'success' => true,
                'user' => $user,
                'jwt' => $jwt,
                'exp' => $payload['exp'],
            ];
            $this->sendNotification($user->nombre." ".$user->apellido." ha iniciado sesion desde la App Movil 😃📱");
        }
        return response()->json($data, $data['code']);
    }

    public function logout(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                Auth::guard('api')->logout();
                $data = [
                    'code' => 400,
                    'success' => false,
                    'message' => 'Usuario no encontrado.',
                    'status' => 'error',
                ];
            } else {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'success' => true,
                    'message' => "Su sesión se ha cerrado correctamente.",
                ];
            }

            $this->guardarEventoApi($user, "Cerrar Sesion", "cerró sesión desde Api-Rest"); //bitacora

        } catch (TokenExpiredException $e) {
            $data = [
                'code' => 401,
                'success' => false,
                'message' => 'Token expiró.',
                'status' => 'error',
            ];
        } catch (TokenInvalidException $e) {
            $data = [
                'code' => 498,
                'success' => false,
                'message' => 'Token inválido.',
                'status' => 'error',
            ];
        } catch (JWTException $e) {
            $data = [
                'code' => 403,
                'success' => false,
                'message' => 'Token ausente.',
                'status' => 'error',
            ];
        }
        return response()->json($data, $data['code']);
    }
}
