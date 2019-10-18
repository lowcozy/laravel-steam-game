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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');