<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::middleware('auth:sanctum')->post('/admin/logout', [AdminController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/user/logout', [UserController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});