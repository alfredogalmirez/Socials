<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function Toggle(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        auth()->user()->following()->toggle($user->id);

        return back()->with('success', 'Follow status updated!');
    }
}
