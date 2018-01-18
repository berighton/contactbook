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
});

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('register', 'Auth\LoginController@showRegistrationForm');


Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::delete('/contact/{contact_id?}', 'ContactController@delete');
Route::post('/contact', 'ContactController@create');
Route::put('/contact/{contact_id?}', 'ContactController@update');


