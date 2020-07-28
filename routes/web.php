<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get("user/home", "UserController@index")->middleware('User');
Route::get("admin/home", "AdminController@index")->middleware('Admin');
Route::post('/user', "UserController@create");
Route::delete('/user/destroy-activity', "UserController@destroyActivity");
Route::patch('user/status', 'UserController@updateStatus')->name('users.update.status');
Route::patch('/user/update-activity', 'UserController@editActivity');
Route::patch('/user/done', 'UserController@updateStatusDone');
Route::patch('/user/undone', 'UserController@updateStatusUnDone');
Route::delete('/user/destroy', 'UserController@destroyAllActivity');
Route::patch("/restore-activity", "AdminController@restoreActivity");