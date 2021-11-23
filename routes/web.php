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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Controller@login')->name('login');
Route::post('login', 'Controller@auth')->name('user.auth');
Route::get('logout', 'Controller@logout')->name('logout');

Route::middleware(['auth'])->group(function () {

    // Route::get('dashboard', 'DashboardController@index')->name('user.dashboard');
    Route::get('user/movement', 'MovementsController@index')->name('movement.index');
    Route::get('movement/statement', 'MovementsController@statement')->name('movement.statement');
    Route::get('movement/deposit', 'MovementsController@deposit')->name('movement.deposit');
    Route::post('movement/deposit', 'MovementsController@depositStore')->name('movement.deposit.store');
    Route::get('movement/withdraw', 'MovementsController@withdraw')->name('movement.withdraw');
    Route::post('movement/withdraw', 'MovementsController@withdrawStore')->name('movement.withdraw.store');

    Route::resource('user', 'UsersController');
    Route::resource('institution', 'InstitutionsController');
    Route::resource('institution.product', 'ProductsController');
    Route::resource('group', 'GroupsController');

    Route::post('group/{group_id}/user', 'GroupsController@userStore')->name('group.user.store');
    // Route::get('user', 'UsersController@index')->name('user.index');
});
