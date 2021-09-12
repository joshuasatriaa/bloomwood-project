<?php

use App\Http\Controllers\AddressAreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MeController;
use App\Http\Controllers\NavigationGroupController;
use App\Http\Controllers\ProductAddOnController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestimonyController;
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
    Route::apiResource('product-images', ProductImageController::class)->only(['destroy']);
    Route::apiResource('product-variants', ProductVariantController::class)->only(['destroy']);
    Route::apiResource('product-add-ons', ProductAddOnController::class)->only(['destroy']);

    Route::apiResource('address-areas', AddressAreaController::class)->except(['index', 'show']);
    Route::apiResource('navigation-groups', NavigationGroupController::class)->except(['index', 'show']);
    Route::apiResource('invoices', InvoiceController::class);

    Route::apiResource('contact-us', ContactUsController::class)->except(['store']);
    Route::apiResource('testimonies', TestimonyController::class)->except(['index', 'show']);
});

Route::apiResource('testimonies', TestimonyController::class)->only(['index', 'show']);
Route::apiResource('contact-us', ContactUsController::class)->only('store');
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('navigation-groups', NavigationGroupController::class)->only(['index', 'show']);
Route::apiResource('address-areas', AddressAreaController::class)->only(['index', 'show']);

Route::post('/auth/token', TokenController::class);
