<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware(['auth:sanctum'])->post('/logout',[AuthController::class,'logout']);










Route::middleware(['auth:sanctum'])->group(function(){

Route::resource('categories',CategoryController::class);
Route::resource('tags',TagController::class);
Route::resource('/post',PostController::class);

Route::get('/comments',[CommentController::class,'index']);
Route::get('/comments/{comment}',[CommentController::class,'show']);
Route::post('/comments/{post}',[CommentController::class,'store']);
Route::put('/posts/{post}/update/{comment}',[CommentController::class,'update']);
Route::delete('/comments/{comment}',[CommentController::class,'destroy']);


});
