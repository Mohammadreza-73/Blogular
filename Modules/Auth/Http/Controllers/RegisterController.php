<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Auth::register');
    }
}