<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
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

        auth()->login($user);

        return to_route('admin.panel');
    }
}