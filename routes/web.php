<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/comments', [CommentController::class, 'show'])->name('posts.comment.show');
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comment.store');



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register.create');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.login');
});
