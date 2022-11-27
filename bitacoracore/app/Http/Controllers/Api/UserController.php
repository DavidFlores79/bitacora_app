<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function getUser(Request $request) {
        
        return $request->user();

    }

    public function getPayload(Request $request) {

        try {
            $payload = JWTAuth::parseToken()->getPayload();
        } catch (TokenExpiredException $e ) {
            if (env('JWT_FORCE_GET_PAYLOAD', false)) {
                $payload = JWTAuth::manager()->getJWTProvider()->decode(JWTAuth::getToken()->get());
            } else {
                throw new TokenExpiredException('Token has expired');
            }
        }

        return $payload;

    }
}
