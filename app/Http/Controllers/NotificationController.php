<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(){

        return Inertia::render('Notifications/Index', [
            'notifications' => auth()->user()->notifications()->with('actor')->latest()->get()
        ]);
    }
}
