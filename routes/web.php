<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


// Rutas para el perfil

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/editar-perfil',[PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('/editar-perfil',[PerfilController::class, 'store'])->name('perfil.store')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'] )->name('register');
Route::post('/register', [RegisterController::class, 'store'] );


Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');



Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store')->middleware('auth');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store')->middleware('auth');

// Like a las fotos

Route::Post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.like.store')->middleware('auth');
Route::Delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.like.destroy')->middleware('auth');

//Siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow')->middleware('auth');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow')->middleware('auth');