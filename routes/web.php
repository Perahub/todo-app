<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    $get_role = Auth::user()->name;
    $get_users = User::where("name", "user")->get();
    return view('dashboard', compact("get_users", "get_role"));
})->name('dashboard');

Route::get('/todo', 'todoController@index')->name('todo');
Route::post('/store-todo', 'todoController@store');
Route::post('/assign-todo', 'todoController@assign');
Route::post('/complete-todo', 'todoController@complete');
Route::post('/delete-todo', 'todoController@destroy');
Route::post('/update-todo', 'todoController@update');
