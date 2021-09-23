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
    });

    /** Logout */
    Route::get('logout', 'AuthController@logout')->name('logout');

});


09:16
