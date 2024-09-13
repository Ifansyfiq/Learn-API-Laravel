<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureCommentIsAuthorized;
use App\Http\Middleware\EnsurePostIsAuthorized;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('me', [AuthenticationController::class, 'me']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(EnsurePostIsAuthorized::class);
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(EnsurePostIsAuthorized::class);

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware(EnsureCommentIsAuthorized::class);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware(EnsureCommentIsAuthorized::class);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::post('/login', [AuthenticationController::class, 'login']);
