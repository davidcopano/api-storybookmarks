<?php

use App\Bookmark;
use Illuminate\Http\Request;
use w3lifer\netscapeBookmarks\NetscapeBookmarks;

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

Route::group(['middleware' => 'cors'], function() {
    Route::post('login', 'Auth\LoginController@validateLogin')->name('login');
    Route::post('social-login', 'Auth\LoginController@socialLogin')->name('social_login');
    Route::post('register', 'Auth\RegisterController@create')->name('register');
    Route::post('forgot-password','Auth\ForgotPasswordController@reset')->name('forgot_password');
});

Route::group(['middleware' => ['web']], function() {
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::view('recovered-password', 'auth.passwords.recovered');
});

Route::group(['middleware' => ['cors', 'auth:api']], function() {
    Route::patch('edit-profile', 'EditProfileController')->name('edit_profile');
    Route::resources([
        'bookmarks' => 'BookmarksController',
        'folders' => 'FoldersController',
        'tags' => 'TagsController',
    ]);
    Route::get('folders/{id}/bookmarks', 'FoldersController@getBookmarksById')->name('folders.get_bookmarks_by_id');
    Route::get('search', 'SearchController')->name('search');
});

Route::get('/export-bookmarks-as-html', function() {
    $bookmarks = Bookmark::where('user_id', 4)->limit(10)->get();
    $bookmarksArray = $bookmarks->map(function (Bookmark $bookmark) {
        return [
            $bookmark->title => $bookmark->url
        ];
    });
    $html = new NetscapeBookmarks($bookmarksArray);
    return response()->streamDownload(function () use ($html) {
        echo $html;
    }, 'bookmarks.html');
});
