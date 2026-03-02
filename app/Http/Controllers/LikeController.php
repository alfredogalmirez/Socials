<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {

        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create([
                'user_id' => Auth::id(),
            ]);

            if ($post->user_id !== Auth::id()) {
                Notification::create([
                    'user_id' => $post->user_id,
                    'actor_id' => Auth::id(),
                    'type' => 'like',
                    'post_id' => $post->id,
                ]);
            }
        }

        return back();
    }
}
