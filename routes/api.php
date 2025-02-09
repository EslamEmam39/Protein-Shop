<?php

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// categories 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories',  CategoryController::class);
});
// brands 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('brands',  BrandController::class);
});
// products 
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
});

// related 
Route::get('/products/{id}/related', [ProductController::class, 'relatedProducts']);


// Tags 
Route::get('/tags', [TagController::class, 'index']);
Route::post('/tags', [TagController::class, 'store']);
Route::delete('/tags/{id}', [TagController::class, 'destroy']);

Route::post('/products/{id}/tags', [ProductController::class, 'attachTags']);
// cart 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
});

 // orders 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/checkout', [OrderController::class, 'store']);
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateOrderStatus']);
});
 // reviews 
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products/{product_id}/reviews', [ReviewController::class, 'store']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
});

Route::get('/products/{product_id}/reviews', [ReviewController::class, 'index']);

 // favourites 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favourites', [FavouriteController::class, 'index']);
    Route::post('/favourites/{id}', [FavouriteController::class, 'store']);
    Route::delete('/favourites/{id}', [FavouriteController::class, 'destroy']);
});


 

 
