<?php

use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// route auth login
Route::get('panel/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('panel/admin/auth', [AuthController::class, 'login'])->name('auth');
Route::post('panel/admin/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
    // route dashboard
    Route::get('panel/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // route product
    Route::resource('panel/admin/product', SubCategoryController::class);
    // route category
    Route::get('panel/admin/category/fetch', [CategoryController::class, 'fetch'])->name('category.fetch');
    Route::post('panel/admin/category/change-active', [CategoryController::class, 'change_active'])->name('category.changeActive');
    Route::post('panel/admin/category/destroy-selected', [CategoryController::class, 'destroy_selected'])->name('category.destroySelected');
    Route::post('panel/admin/category/destroy-soft/{id}', [CategoryController::class, 'destroy_soft'])->name('category.destroySoft');
    Route::resource('panel/admin/category', CategoryController::class);
    // route sub category
    Route::get('panel/admin/sub-category/fetch', [SubCategoryController::class, 'fetch'])->name('sub-category.fetch');
    Route::post('panel/admin/sub-category/change-active', [SubCategoryController::class, 'change_active'])->name('sub-category.changeActive');
    Route::post('panel/admin/sub-category/destroy-selected', [SubCategoryController::class, 'destroy_selected'])->name('sub-category.destroySelected');
    Route::post('panel/admin/sub-category/destroy-soft/{id}', [SubCategoryController::class, 'destroy_soft'])->name('sub-category.destroySoft');
    Route::resource('panel/admin/sub-category', SubCategoryController::class);
    // route category
    Route::get('panel/admin/brand/fetch', [BrandController::class, 'fetch'])->name('brand.fetch');
    Route::post('panel/admin/brand/change-active', [BrandController::class, 'change_active'])->name('brand.changeActive');
    Route::post('panel/admin/brand/destroy-selected', [BrandController::class, 'destroy_selected'])->name('brand.destroySelected');
    Route::post('panel/admin/brand/destroy-soft/{id}', [BrandController::class, 'destroy_soft'])->name('brand.destroySoft');
    Route::resource('panel/admin/brand', BrandController::class);
});
