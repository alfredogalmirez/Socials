<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/comments', [CommentController::class, 'show'])->name('posts.comment.show');
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comment.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comment.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/profile/edit', [CustomProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [CustomProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user:username}', [CustomProfileController::class, 'show'])->name('profile.show');
    Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');

    Route::post('/user/{user}/follow', [FollowController::class, 'toggle'])->name('follow.toggle');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register.create');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
});

// require __DIR__.'/auth.php';
