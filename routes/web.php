<?php

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    $links = \App\Link::all();

    return view('welcome', ['links' => $links]);
});
Route::get('/about', function () {
    $links = \App\Link::all();

    return view('about', ['links' => $links]);
});
Route::get('/pictest', function () {
    $links = \App\Link::all();

    return view('pictureTestPage', ['links' => $links]);
});