<?php

namespace Modules\Auth\Http\Controllers;

class LoginController
{
    public function index()
    {
        return view('Auth::login');
    }
}