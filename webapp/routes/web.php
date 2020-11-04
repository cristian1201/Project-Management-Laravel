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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
//    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('teams','TeamController');
//    Route::resource('products','ProductController');
    Route::get('editProfile/', 'HomeController@editProfile')->name('home.editProfile');
    Route::post('updateProfile/', 'HomeController@updateProfile')->name('home.updateProfile');
});
