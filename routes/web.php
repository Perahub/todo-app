<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\todoController;

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
    if (Auth::check()){
        return redirect('dashboard');
    }else{
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

})->name('welcome');
// todos management Routes***
Route::middleware([ 'auth:sanctum', 'verified' ])->get('/dashboard', [ todoController::class, 'index' ])->name('dashboard');
Route::middleware([ 'auth:sanctum', 'verified' ])->prefix('/todo')->group(function(){
    Route::post('/store', [ todoController::class, 'store' ]);
    Route::put('/{id}', [ todoController::class, 'update' ]);
    Route::put('/toggle/{id}', [ todoController::class, 'toggleTodo' ]);
    Route::delete('/deleteAll', [ todoController::class, 'deleteAll' ]);
    Route::delete('/{id}', [ todoController::class, 'destroy' ]);
});
// Roles management Routes***
Route::middleware([ 'auth:sanctum', 'verified', 'IsAdministrator' ])->get('/RolesManagement', [ RolesController::class, 'index' ])->name('RolesManagement');
Route::middleware([ 'auth:sanctum', 'verified', 'IsAdministrator' ])->prefix('/role')->group(function(){
    Route::post('/store', [ RolesController::class, 'store' ]);
    Route::put('/{id}', [ RolesController::class, 'update' ]);
    Route::delete('/{id}', [ RolesController::class, 'destroy' ]);
});
// User management route***
Route::middleware([ 'auth:sanctum', 'verified', 'IsAdministrator' ])->get('/UsersManagement', [ UsersController::class, 'index' ])->name('UsersManagement');
Route::middleware([ 'auth:sanctum', 'verified', 'IsAdministrator' ])->prefix('/user')->group(function(){
    Route::post('/store', [ UsersController::class, 'store' ]);
    Route::put('/{id}', [ UsersController::class, 'update' ]);
    Route::delete('/{id}', [ UsersController::class, 'destroy' ]);
});
