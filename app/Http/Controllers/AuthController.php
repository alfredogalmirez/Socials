<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . auth()->id(),
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Welcome ' . $user->name . '!');
    }

    public function loginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['login'])->orWhere('username', $validated['login'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home')->with('success', 'Welcome back ' . $user->name . '!');
        } else {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfuly!');
    }
}
