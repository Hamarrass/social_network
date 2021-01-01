<?php

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

Route::get('/posts/{id}/{author?}',function($id,$author='hassan'){

    $posts =[
        1=>['title'=>'<a>learn laravel 6</a>'],
        2=>['title'=>'learn Angular 8'],
    ];

    return  view('posts.show',['data'=>$posts[$id],'author'=>$author]);
});

/*
Route::get('/', function () {
    return view('home ');
});
*/

/*if you don t want to pass any params  it will be better to use this method*/
Route::view('/', 'home');
/*and the same for this method*/
/*Route::get('/about', function () {
    return view('about  ');
});*/
Route::view('/about', '');
