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

use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Controller@login')->name('user.login');
Route::post('login', 'DashboardController@auth')->name('user.auth');
Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');

Route::resource('user', 'UsersController');
Route::resource('institution', 'InstitutionsController');
Route::resource('institution.product', 'ProductsController');
Route::resource('group', 'GroupsController');

Route::post('group/{group_id}/user', 'GroupsController@userStore')->name('group.user.store');
// Route::get('user', 'UsersController@index')->name('user.index');
