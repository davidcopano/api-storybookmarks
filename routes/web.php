<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Auth\LoginController@validateLogin')->name('login');
Route::post('register', 'Auth\RegisterController@create')->name('register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::resources([
        'bookmarks' => 'BookmarksController',
        'folders' => 'FoldersController'
    ]);
});
