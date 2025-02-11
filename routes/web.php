<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories',  'index' )->name('all.categories');
    Route::get('/add-category', 'add_category' )->name('add.category');
    Route::post('/store-category', 'store' )->name('store.category');
    Route::get('/edit-category/{id}','show' )->name('edit.category');
    Route::put('/category/{id}/update', 'update' )->name('update.category');
    Route::delete('/category/{id}', 'destroy' )->name('destroy.category');
});

