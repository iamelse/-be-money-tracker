<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    use ApiResponseTrait;

    public function me()
    {
        return $this->success(Auth::user());
    }
}
