<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
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

Route::prefix('/auth')->group(function() {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/{user}', [AuthController::class, 'show']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    // Categories
    Route::post('/categories',[ProductCategoryController::class, 'store']);
    Route::put('/categories/{category}',[ProductCategoryController::class, 'update']);
    Route::delete('/categories/{category}',[ProductCategoryController::class, 'destroy']);

    
    // product
    //create item
    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('role:seller');
    //update
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->middleware('role:seller');
    //delete item
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('role:seller');

});


// PRODUCT
Route::get('products/search/{name}', [ProductController::class, 'search']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);

// CATEGORIES
Route::get('/categories', [ProductCategoryController::class, 'index']);








