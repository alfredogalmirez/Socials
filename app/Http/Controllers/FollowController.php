<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function Toggle(User $user){
        $follower = Auth::id();

        if($follower->id === $user->id){
            return back();
        }

    }
}
