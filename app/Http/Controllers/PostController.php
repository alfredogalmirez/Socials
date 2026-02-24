<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with(['user', 'comments.user'])->withCount('likes')->latest()->paginate(10)->through(fn($post) => [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'content' => $post->content,
            'image' => $post->image,
            'create_at' => $post->created_at->diffForHumans(),
            'user' => $post->user,
            'likes_count' => $post->likes_count,
            'is_liked' => auth()->check()
                ? $post->likes->where('user_id', auth()->id())->isNotEmpty()
                : false,
            'comments' => $post->comments,
        ]);

        return Inertia::render('Home', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required_without:image|nullable|string|max:280|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Post created.');
    }

    public function delete(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully!');
    }
}
