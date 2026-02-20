<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {

        $posts = Comment::with(['user', 'comments.user'])->latest()->paginate();

        return view('app', compact('posts'));
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content'  =>  'required|min:1|max:280|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment posted.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'You cannot delete someone else\'s comment!');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
