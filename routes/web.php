<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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


/*if you don t want to pass any params  it will be better to use this method*/
Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/about', [HomeController::class , 'about'])->name('about');
Route::get('/secret', [HomeController::class , 'secret'])->name('secret')->middleware('can:secret.page');

Route::delete('/posts/{id}/forcedelete',[PostController::class,'forcedelete']);
Route::patch('/posts/{id}/restore' , [PostController::class ,'restore']);
Route::get('/posts/archive',[PostController::class ,'archive']);
Route::get('/posts/all',[PostController::class ,'all']);
Route::resource('/posts', PostController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
