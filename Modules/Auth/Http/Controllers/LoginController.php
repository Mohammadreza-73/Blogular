<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth::login');
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return to_route('admin.panel');
        }

        return back()->with('error', 'Email or password is incorrect');
    }
}