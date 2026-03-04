<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function Toggle(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        auth()->user()->following()->toggle($user->id);

        Notification::create([
            'user_id' => $user->id,
            'actor_id' => Auth::id(),
            'type' => "follow",
        ]);

        return back()->with('success', 'Follow status updated!');
    }
}
