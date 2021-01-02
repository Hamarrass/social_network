<?php

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
Route::resource('/posts', PostController::class);
