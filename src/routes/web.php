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

// Custom register
Route::get('/register','RegisterController@create')->name('register:form');
Route::post('/register','RegisterController@store')->name('register');

// Custom auth
Route::get('/login','AuthController@create')->name('login');
Route::post('/login','AuthController@store')->name('auth');
Route::get('/logout','AuthController@destroy')->name('logout');

// Default password reset.
Route::group(['middleware' => 'guest', 'prefix' => 'password', 'namespace' => 'Auth'], function () {
    Route::post('/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/reset','ResetPasswordController@reset');
    Route::get('/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});

// Default password reset.
Route::group(['middleware' => 'auth'], function () {

    // Crud routing the Howl controller, Do not route for update and edit.
    Route::resource('howl', 'HowlController', ['except' => ['edit', 'update', 'show']]);

    Route::post('/{name}/follow', 'FollowerController@toggle')->name('follow.toggle');
    Route::get('/{name}/following', 'FollowerController@following')->name('follower.following');
    Route::get('/{name}/followers', 'FollowerController@followers')->name('follower.followers');
    Route::get('/{name}', 'HowlController@index')->name('howl.user');

});

// Home, Index page.
Route::get('/', 'HomeController@index')->name('home');