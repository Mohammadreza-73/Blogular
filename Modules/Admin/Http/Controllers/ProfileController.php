<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(auth()->id());

        return view('Admin::profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => $request->user_password,
        ]);

        return back()->with('success', 'User Profile updated successfully.');
    }
}