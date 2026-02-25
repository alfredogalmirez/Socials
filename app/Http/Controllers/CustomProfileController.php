<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomProfileController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount('posts')->load([
            'posts' => function ($query) {
                $query->latest()->take(4)->withCount('likes');
            }
        ]);

        $totalLikes = Like::whereIn('post_id', $user->posts()->pluck('id'))->count();

        return Inertia::render('ProfilePage', [
            'profileUser' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'initial' => substr($user->name, 0, 1),
                'posts_count' => $user->posts_count,
                'total_likes' => $totalLikes,
                'member_since' => $user->created_at->format('M Y'),
                'posts' => $user->posts->map(fn($post) => [
                    'id' => $post->id,
                    'content' => $post->content,
                    'created_at_human' => $post->created_at->diffForHumans(),
                    'likes_counts' => $post->likes_count,
                ]),
            ],
            'isFollowing' => auth()->check() ? auth()->user()->following()->where('followed_id', $user->id)->exists() : false,
        ]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|alpha_dash|max:255|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated); // IDE Warning only, don't mind!

        return back()->with('success', 'Changes saved successfully!');
    }
}
