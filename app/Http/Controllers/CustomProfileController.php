<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use VercelBlobPhp\Client;
use VercelBlobPhp\CommonCreateBlobOptions;

class CustomProfileController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount(['posts', 'followers', 'following'])->load([
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
                'avatar' => $user->avatar ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar)) : null,
                'initial' => substr($user->name, 0, 1),
                'posts_count' => $user->posts_count,
                'followers_count' => $user->followers_count,
                'following_count' => $user->following_count,
                'total_likes' => $totalLikes,
                'member_since' => $user->created_at->format('M Y'),
                'posts' => $user->posts->map(function ($post) {

                    $imagePath = $post->image;

                    if ($imagePath && !str_starts_with($imagePath, 'http')) {
                        $imagePath = asset('storage/' . $imagePath);
                    }

                    return [
                        'id' => $post->id,
                        'content' => $post->content,
                        'created_at_human' => $post->created_at->diffForHumans(),
                        'likes_counts' => $post->likes_count,
                    ];
                }),
            ],
            'isFollowing' => auth()->check() ? auth()->user()->following()->where('followed_id', $user->id)->exists() : false,
        ]);
    }

    public function edit()
    {
        return Inertia::render('Profile/EditProfile', ['user' => Auth::user()]);
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
            $client = new Client();

            if ($user->avatar && str_starts_with($user->avatar, 'http')) {
                try {
                    $client->del([$user->avatar]);
                } catch (\Exception $e) {
                    logger("Failed to delete blob: " . $e->getMessage());
                }
            }

            $file = $request->file('avatar');
            $filename = 'socials/avatars/' . time() . '-' . $file->getClientOriginalName();

            $options = new CommonCreateBlobOptions(
                access: 'public',
                addRandomSuffix: true
            );

            $result = $client->put(
                $filename,
                file_get_contents($file->getRealPath()),
                $options,
            );

            $validated['avatar'] = $result->url;
        }

        $user->update($validated); // IDE Warning only, don't mind!

        return back()->with('success', 'Changes saved successfully!');
    }
}
