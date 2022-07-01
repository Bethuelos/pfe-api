<?php

use App\Http\Controllers\BuildingPermitsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\PlanningCertificatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\RequestsController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UsersController::class, 'register']);

Route::post('/login', [UsersController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Users
    Route::prefix('user')->group(function () {

        Route::get('/user', [UsersController::class, 'user']);
        Route::get('/users', [UsersController::class, 'users']);
        Route::get('/users/{id}', [UsersController::class, 'specific']);
        Route::post('/logout', [UsersController::class, 'logout']);
        Route::put('/modify/{id}', [UsersController::class, 'modify']);
        Route::delete('/delete/{id}', [UsersController::class, 'delete']);

    });

    // Requests
    Route::post('request/{type}', [RequestsController::class, 'register']);
    Route::get('request/{type}/{id?}', [RequestsController::class, 'retrieve']);
    // Route::get('request/', [RequestsController::class, 'retrieveDocs']);
    Route::put('request/{type}/{id}', [RequestsController::class, 'modify']);
    Route::delete('request/{type}/{id}', [RequestsController::class, 'delete']);

    // set Avatar
    Route::post('avatar/', [UsersController::class, 'avatar']);

    // Retrieve Documents
    Route::get('mydocs/{no_request?}/{doc?}', [FilesController::class, 'download']);

});
