<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use ApiResponseTrait;
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('Unauthorized', 401);
            }
        } catch (JWTException $e) {
            return $this->error('Could not create token', 500);
        }

        return $this->success(['token' => $token], 'Login successful');
    }
}
