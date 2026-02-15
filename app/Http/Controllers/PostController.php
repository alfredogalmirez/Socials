<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('user')->latest()->paginate(10);

        return view('app', compact('posts'));
    }

    public function store(Request $request){
       $validated = $request->validate([
            'content' => 'required|string|max:280|min:1',
       ]);

       Post::create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
       ]);

       return back()->with('success', 'Post created.');
    }
}
