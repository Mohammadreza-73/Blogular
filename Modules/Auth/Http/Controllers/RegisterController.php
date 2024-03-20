<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function view()
    {
        return view('Auth::register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->all());

        // Auth::login($user);
        auth()->login($user);

        // 2. Fire send email envet

        // 3. Login user to dashboard
        return to_route('auth.login');
    }
}