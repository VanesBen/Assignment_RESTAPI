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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('products/search/{name}', [ProductController::class, 'search']);
Route::apiResource('categories', ProductCategoryController::class);

// PRODUCTS
Route::get('/products', [ProductController::class, 'index']);
//create item
Route::post('/products', [ProductController::class, 'store'])
    ->middleware(['auth:sanctum', 'role:seller']);;
// show itme
Route::post('/products/{product}', [ProductController::class, 'show']);
//update item
Route::put('/products/{product}', [ProductController::class, 'update'])
    ->middleware(['auth:sanctum', 'role:seller,owner']);

//delete item
Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware(['auth:sanctum', 'role:seller,owner']);

// Route::apiResource('products', ProductController::class);




