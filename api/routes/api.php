<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', MeController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class)->only('index');
    Route::post('/suspend-user/{user}', [UserController::class, 'suspendUser']);
    Route::post('/unsuspend-user/{user}', [UserController::class, 'unSuspendUser']);

    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
});

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

Route::post('/auth/token', TokenController::class);
