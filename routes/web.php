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

Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('home');
    });
    Route::post('/logout', 'UserController@logout')->name('logout');
    Route::get('urls/{user_id}', 'ShortenerController@index');
});

Route::get('visit/{short}', 'ShortenerController@show');

Route::get('/login', 'UserController@index')->name('login');
Route::get('/register', 'UserController@register')->name('register');

Route::post('/auth', 'UserController@auth')->name('auth');
Route::post('/save', 'UserController@store')->name('store');