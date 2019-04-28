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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('roles', 'admin\RolesController');
    Route::resource('users', 'admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::get('preferred_language/{lang}', 'admin\UsersController@preferred_language')->name('preferred_language');
});

// Change Password Routes...
Route::get('/showChangePasswordForm', 'admin\ChangePasswordController@showChangePasswordForm')->name('showChangePasswordForm');
Route::post('/change_password', 'admin\ChangePasswordController@changePassword')->name('change_password');

