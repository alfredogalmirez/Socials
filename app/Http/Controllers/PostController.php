<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use VercelBlobPhp\CommonCreateBlobOptions;
use VercelBlobPhp\Client;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with(['user', 'comments.user'])->withCount('likes')->latest()->paginate(10)->through(function ($post) {

            $image = $post->image;

            if ($image && !str_starts_with($image, 'http')) {
                $image = asset('storage/' . $image);
            }

            return [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'content' => $post->content,
                'image' => $post->image,
                'create_at' => $post->created_at->diffForHumans(),
                'user' => $image,
                'likes_count' => $post->likes_count,
                'is_liked' => auth()->check()
                    ? $post->likes->where('user_id', auth()->id())->isNotEmpty()
                    : false,
                'comments' => $post->comments,
            ];
        });

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
            $client = new Client();

            $file = $request->file('image');

            $filename = 'socials/posts/' . time() . '-' . $file->getClientOriginalName();

            $options = new CommonCreateBlobOptions(
                access: 'public',
                addRandomSuffix: true // prevents files with the same name from overwriting each other
            );

            $result = $client->put(
                $filename,
                file_get_contents($file->getRealPath()),
                $options
            );

            $imagePath = $result->url;
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
