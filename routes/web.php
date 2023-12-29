<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// App\Models\Post

Route::middleware(['auth'])->group(function(){
//POST ROUTES
    Route::middleware(['can:viewAny,App\Models\Post'])->get('/',[PostController::class,'index'])->name('post.index');

    Route::middleware(['can:create,App\Models\Post'])->get('posts/create',[PostController::class,'Create'])->name('post.create');
    Route::middleware(['can:create,App\Models\Post'])->post('posts/store',[PostController::class,'store'])->name('post.store');

    Route::middleware(['can:update,post'])->get('posts/{post}/edit', [PostController::class,'edit'])->name('post.edit');
    Route::middleware(['can:update,post'])->put('posts/{post}',[PostController::class,'update'])->name('post.update');

    Route::middleware(['can:view,post'])->get('posts/{post}',[PostController::class,'show'])->name('post.show');

    Route::middleware(['can:delete,post'])->delete('posts/{post}/delete',[PostController::class,'destroy'])->name('post.delete');
//
//COMMENT ROUTES
    Route::middleware(['can:create,App\Models\Comment'])->get('posts/{post}/comment',[CommentController::class,'create'])->name('comment.add');
    Route::middleware(['can:create,App\Models\Comment'])->post('posts/{post}',[CommentController::class,'store'])->name('comment.store');

    Route::middleware(['can:update,comment'])->get('posts/{post}/edit/{comment}',[CommentController::class,'edit'])->name('comment.edit');
    Route::middleware(['can:update,comment'])->put('posts/{post}/update/{comment}',[CommentController::class,'update'])->name('comment.update');

    Route::middleware(['can:delete,comment'])->delete('posts/{post}/delete/{comment}',[CommentController::class,'destroy'])->name('comment.delete');
//CATEGORY ROUTES
    Route::middleware(['can:viewAny,App\Models\Category'])->get('categories/',[CategoryController::class,'index'])->name('category.index');

    Route::middleware(['can:create,App\Models\Category'])->get('categories/create',[CategoryController::class,'create'])->name('category.create');
    Route::middleware(['can:create,App\Models\Category'])->post('categories/store',[CategoryController::class,'store'])->name('category.store');
    Route::middleware(['can:update,category'])->get('categories/{category}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::middleware(['can:update,category'])->put('categories/{category}',[CategoryController::class,'update'])->name('category.update');

    Route::middleware(['can:delete,category'])->delete('categories/{category}/delete',[CategoryController::class,'destroy'])->name('category.delete');
//
//TAG ROUTES

    Route::middleware(['can:viewAny,App\Models\Tag'])->get('tags/',[TagController::class,'index'])->name('tag.index');
    Route::middleware(['can:create,App\Models\Tag'])->get('tags/create',[TagController::class,'create'])->name('tag.create');
    Route::middleware(['can:create,App\Models\Tag'])->post('tags/store',[TagController::class,'store'])->name('tag.store');
    Route::middleware(['can:update,tag'])->get('tags/{tag}/edit', [TagController::class,'edit'])->name('tag.edit');
    Route::middleware(['can:update,tag'])->put('tags/{tag}',[TagController::class,'update'])->name('tag.update');
    Route::middleware(['can:delete,tag'])->delete('tag/{tag}/delete',[TagController::class,'destroy'])->name('tag.delete');
//
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    });


    Route::middleware(['guest'])->group(function(){
        Route::get('login',[AuthController::class ,'showLoginForm'])->name('showlogin');
        Route::post('login',[AuthController::class ,'login'])->name('login');
        Route::get('register', [AuthController::class ,'showRegisterForm'])->name('showregister');
        Route::post('register',[AuthController::class ,'register'])->name('register');
        });
