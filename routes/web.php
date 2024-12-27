<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// register and auhtentication
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/store', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::group(['middleware' => 'auth'], function () {
    // posts management
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//profile
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// comments
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

});
