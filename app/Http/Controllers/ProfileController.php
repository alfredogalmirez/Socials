<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile', compact('user'));
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|alpha_dash|max:255|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:500',
        ]);

        if($request->hasFile('avatar')){
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated); // IDE Warning only, don't mind!

        return back()->with('success', 'Changes saved successfully!');
    }
}
