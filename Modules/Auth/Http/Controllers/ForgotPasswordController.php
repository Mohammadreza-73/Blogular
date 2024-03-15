<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('Auth::forgot-password');
    }
}