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

        $result = auth()->user()->following()->toggle($user->id);

        if(count($result['attached']) > 0){
             Notification::updateOrCreate([
            'user_id' => $user->id,
            'actor_id' => Auth::id(),
            'type' => "follow",
            'created_at' => now(),
        ]);

        }

        return back()->with('success', 'Follow status updated!');
    }
}
