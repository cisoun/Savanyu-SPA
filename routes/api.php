<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/artworks', 'ArtworkController@index');
Route::get('/categories', 'CategoryController@index');
Route::get('/uploads', 'UploadController@index');
Route::get('/videos', 'VideoController@index');
Route::get('/welcome', 'WelcomeController@index');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/welcome', 'WelcomeController@update');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::prefix('artwork')->group(function () {
        Route::post('store', 'ArtworkController@store');

        Route::delete('{id}', 'ArtworkController@destroy')->where('id', '[0-9]+');
        Route::post('{id}', 'ArtworkController@update')->where('id', '[0-9]+');
    });

    Route::prefix('upload')->group(function () {
        Route::delete('{id}', 'UploadController@destroy')->where('id', '[0-9]+');
    });

    Route::prefix('biography')->group(function () {
        Route::prefix('event')->group(function () {
            Route::get('index', 'BiographyEventController@index');
            Route::post('store', 'BiographyEventController@store');

            Route::delete('{id}', 'BiographyEventController@destroy')->where('id', '[0-9]+');
            Route::patch('{id}', 'BiographyEventController@update')->where('id', '[0-9]+');
            Route::post('{id}', 'BiographyEventController@update')->where('id', '[0-9]+');
        });

        Route::prefix('section')->group(function () {
            Route::get('index', 'BiographySectionController@index');
            Route::post('store', 'BiographySectionController@store');

            Route::delete('{id}', 'BiographySectionController@destroy')->where('id', '[0-9]+');
            Route::patch('{id}', 'BiographySectionController@update')->where('id', '[0-9]+');
            Route::post('{id}', 'BiographySectionController@update')->where('id', '[0-9]+');
        });
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

});
