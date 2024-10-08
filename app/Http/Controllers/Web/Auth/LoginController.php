<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() : View
    {
        return view('auth.signin', [
            'title' => 'Sign In | CashFlow'
        ]);
    }

    public function doLogin(LoginRequest $request) : RedirectResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('web.app.dashboard'))->with('success', 'Login successful.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
