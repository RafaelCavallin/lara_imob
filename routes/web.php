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

/* Route::get('/', function () {
return view('welcome');
}); */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    /** Formulário de Login */
    Route::post('/login', 'AuthController@login')->name('login.do');
    Route::get('/', 'AuthController@showLoginForm')->name('login');

    /** Rotas protegidas */
    Route::group(['middleware' => ['auth']], function () {
        Route::get('home', 'AuthController@home')->name('home');

        /** Users */
        Route::get('users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');

        /** Companies */
        Route::resource('companies', 'CompanyController');

        /** Properties */
        Route::post('properties/image-set-cover', 'PropertyController@imageSetCover')->name('properties.imageSetCover');
        Route::delete('properties/image-remove', 'PropertyController@imageRemove')->name('properties.imageRemove');
        Route::resource('properties', 'PropertyController');
    });

    /** Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');

});
