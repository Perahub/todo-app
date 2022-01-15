<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


// Auth middleware is enabled inside of HomeController class


Route::group(['prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('/store', [HomeController::class, 'store'])->name('ajax_store');
        Route::get('/all', [HomeController::class, 'all'])->name('ajax_fetch_all');
        Route::post('/delete', [HomeController::class, 'delete'])->name('ajax_delete');
        Route::post('/mark-as-complete', [HomeController::class, 'markAsComplete'])->name('ajax_mark_as_complete');
    });

});
