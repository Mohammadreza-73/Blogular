<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(auth()->id());

        return view('Admin::profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return back()->with('success', 'User Profile updated successfully.');
    }
}