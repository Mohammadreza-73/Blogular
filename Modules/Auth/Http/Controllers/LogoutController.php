<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->logout();

        return to_route('auth.login');
    }
}