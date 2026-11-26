<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;
use Illuminate\Support\Facades\Route;

// Halaman Publik UMKM Surya Nusantara Kopi (PT Surya Rasa Nusantara)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProductCatalogController::class, 'index'])->name('products.index');
Route::get('/produk/{product:slug}', [ProductCatalogController::class, 'show'])->name('products.show');

// Autentikasi Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');
});

// Halaman Admin Terproteksi (CRUD Produk & Kategori)
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);
    });
