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

Auth::routes();

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@start')->name('startcall');
Route::get('/home/delete/{id}', 'HomeController@stop')->name('stopcall');

Route::get('/home/deleteall' , 'HomeController@stopall')->name('stopall');

Route::get('/autodial', 'AutoDialController@index')->name('autodial');
Route::post('/autodial', 'AutoDialController@store')->name('autodial_post');
Route::post('/retrieveinfo', 'AutoDialController@show')->name('retrieveinfo');
Route::get('/log', 'AutoDialController@logresult');
