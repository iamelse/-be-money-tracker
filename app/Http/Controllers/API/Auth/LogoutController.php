<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use ApiResponseTrait;

    public function logout()
    {
        Auth::logout();
        return $this->success(null, 'Successfully logged out');
    }
}
