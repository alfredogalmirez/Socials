<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $like = $post->likes()->where('user_id', auth()->user()->id)->first();

        if($like){
            $like->delete();
        } else {
            $post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        return back();
    }
}
