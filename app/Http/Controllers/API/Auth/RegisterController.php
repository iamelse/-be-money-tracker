<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use Exception;

class RegisterController extends Controller
{
    use ApiResponseTrait;
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $token = JWTAuth::fromUser($user);
        } catch (Exception $e) {
            return $this->error('Registration failed', 500);
        }

        return $this->success(['token' => $token], 'Registration successful');
    }
}