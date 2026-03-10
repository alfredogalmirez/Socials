<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index()
    {

        $notifications = auth()->user()
        ->notifications()
        ->with('actor')
        ->latest()
        ->get()
        ->map(function ($notification) {
            $data = $notification->toArray();
            $data["created_at_human"] = $notification->created_at->diffForHumans();

            if($notification->actor && $notification->actor->avatar){
                $avatar = $notification->actor->avatar;

                $data['actor']['avatar'] = str_starts_with($avatar, 'http') ? $avatar : asset('storage/', $avatar);
            }
            return $data;
        });

        return Inertia::render('Notifications/Index', [
            'notifications' => $notifications
        ]);
    }
}
