<?php

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'API\AuthController@register')->name('api.auth.register');
    Route::post('login', 'API\AuthController@login')->name('api.auth.login');
});

// User Routes...
Route::group(['prefix' => 'users', 'middleware' => 'jwt.auth'], function () {
    Route::get('{user}', 'API\User\UserController@show')->name('api.user.show');

    // Current User Routes...
    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'API\User\UserController@me')->name('api.user.me');

        Route::get('categories', 'API\User\CategoryController@index')->name('api.user.me.category.index');
        Route::post('categories/create', 'API\User\CategoryController@store')->name('api.user.me.category.store');
        Route::delete('categories/{category}', 'API\User\CategoryController@destroy')->name('api.user.me.category.destroy');

        Route::get('provinces', 'API\User\ProvinceController@index')->name('api.user.me.province.index');
        Route::post('provinces/create', 'API\User\ProvinceController@store')->name('api.user.me.province.store');
        Route::delete('provinces/{province}', 'API\User\ProvinceController@destroy')->name('api.user.me.province.destroy');

        Route::get('organizers', 'API\User\OrganizerController@index')->name('api.user.me.organizer.index');
        Route::post('organizers/create', 'API\User\OrganizerController@store')->name('api.user.me.organizer.store');
    });
});

// Category Routes...
Route::group(['prefix' => 'categories', 'middleware' => 'jwt.auth'], function () {
    Route::get('/', 'API\CategoryController@index')->name('api.category.index');
    Route::get('{category}/children', 'API\CategoryController@children')->name('api.category.children');
});

// Province Routes...
Route::group(['prefix' => 'provinces', 'middleware' => 'jwt.auth'], function () {
    Route::get('/', 'API\ProvinceController@list')->name('api.province.index');
    Route::get('{province}/counties', 'API\ProvinceController@counties')->name('api.province.counties');
});

// Address Routes...
Route::group(['prefix' => 'addresses', 'middleware' => 'jwt.auth'], function () {
    Route::get('search', 'API\AddressController@search')->name('api.address.search');
    Route::post('create', 'API\AddressController@store')->name('api.address.store');
});