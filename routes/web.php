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
Route::post('social-login', 'Auth\LoginController@socialLogin')->name('social_login');
Route::post('register', 'Auth\RegisterController@create')->name('register');
Route::post('forgot-password','Auth\ForgotPasswordController@reset')->name('forgot_password');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::group(['middleware' => 'auth:api'], function() {
    Route::resources([
        'bookmarks' => 'BookmarksController',
        'folders' => 'FoldersController',
        'tags' => 'TagsController',
    ]);
});
