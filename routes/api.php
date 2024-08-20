<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('jobs')->controller(\App\Http\Controllers\JobsController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{jobs}', 'show');
        Route::post('/', 'store');
        Route::put('/{jobs}', 'update');
        Route::delete('/{jobs}', 'destroy');
        Route::post('/apply', 'apply');
        Route::post('/applications', 'applications');
    });
});
