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
Route::get('/', 'GamingController@home')->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home-demo');


Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::post('/login-with-disqus', 'AuthController@loginWithDisqus')->name('login-with-disqus');

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('postLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('social-redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');


Route::get('/comment', function () {
    return view('test');
})->name('test');

Route::get('test-game', 'GamingController@test');

//Blog
Route::get('blogs/{id}/{slug}.html', 'BlogController@detail')->name('blog-detail');
Route::get('ajax-comments', 'CommentController@ajaxGetComment')->name('get-comment');
Route::get('blog-list', 'BlogController@ajaxGetListBlog')->name('ajax-get-list-blog');


//Comment
Route::post('post-comment', 'CommentController@postComment')->name('post-comment');
Route::post('ajax-edit-comment', 'CommentController@ajaxEditComment')->name('ajax-edit-comment');
Route::post('ajax-delete-comment', 'CommentController@ajaxDeleteComment')->name('ajax-delete-comment');


//Theme
Route::get('switch-theme', 'GamingController@switchTheme')->name('switch-theme');

//game
Route::get('games/{slug}', 'GamingController@gameDetail')->name('game-detail');


//Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {
//    Route::get('/', 'GamingController@home')->name('home');
//    //game
//    Route::get('games/{slug}', 'GamingController@gameDetail')->name('game-detail');
//});




