<?php

use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ImageUploadTinymceController;
use App\Http\Controllers\Backend\Marketing\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\Product\AttributesController;
use App\Http\Controllers\Backend\Product\AttributesValueController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\SubCategoryController;
use App\Http\Controllers\Backend\Marketing\FlashSaleController;
use App\Http\Controllers\Backend\Website\HomepageController;
use App\Http\Controllers\Frontend\HomeController;
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
    Route::get('panel/admin/product/fetch', [ProductController::class, 'fetch'])->name('product.fetch');
    Route::post('panel/admin/product/create-variants', [ProductController::class, 'create_variants'])->name('product.createVariants');
    Route::post('panel/admin/product/update-variants', [ProductController::class, 'update_variants'])->name('product.updateVariants');
    Route::get('panel/admin/product/generate-item-code', [ProductController::class, 'generate_item_code'])->name('product.generateItemCode');
    Route::get('panel/admin/product/get-value/{id}', [ProductController::class, 'get_value'])->name('product.getValue');
    Route::get('panel/admin/product/get-brand', [ProductController::class, 'get_brand'])->name('product.getBrand');
    Route::get('panel/admin/product/get-category', [ProductController::class, 'get_category'])->name('product.getCategory');
    Route::get('panel/admin/product/sub-category/{id}', [ProductController::class, 'sub_category'])->name('product.subCategory');
    Route::get('panel/admin/product/get-variants/{id}', [ProductController::class, 'get_variants'])->name('product.getVariants');
    Route::resource('panel/admin/product', ProductController::class);
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
    // route sub attributes
    Route::get('panel/admin/attributes/fetch', [AttributesController::class, 'fetch'])->name('attributes.fetch');
    Route::post('panel/admin/attributes/change-active', [AttributesController::class, 'change_active'])->name('attributes.changeActive');
    Route::post('panel/admin/attributes/destroy-selected', [AttributesController::class, 'destroy_selected'])->name('attributes.destroySelected');
    Route::post('panel/admin/attributes/destroy-soft/{id}', [AttributesController::class, 'destroy_soft'])->name('attributes.destroySoft');
    Route::resource('panel/admin/attributes', AttributesController::class);
    // route sub attributes value
    Route::get('panel/admin/attributes-value/fetch/{id}', [AttributesValueController::class, 'fetch'])->name('attributes-value.fetch');
    Route::post('panel/admin/attributes-value/change-active', [AttributesValueController::class, 'change_active'])->name('attributes-value.changeActive');
    Route::post('panel/admin/attributes-value/destroy-selected', [AttributesValueController::class, 'destroy_selected'])->name('attributes-value.destroySelected');
    Route::post('panel/admin/attributes-value/destroy-soft/{id}', [AttributesValueController::class, 'destroy_soft'])->name('attributes-value.destroySoft');
    Route::resource('panel/admin/attributes-value', AttributesValueController::class);
    // route upload image tinymce
    Route::post('panel/admin/upload-tinymce-image', [ImageUploadTinymceController::class, 'upload_image'])->name('tinymce.upload');
    Route::post('panel/admin/delete-tinymce-image', [ImageUploadTinymceController::class, 'delete_image'])->name('tinymce.delete');
    Route::post('panel/admin/update-tinymce-image', [ImageUploadTinymceController::class, 'update_image'])->name('tinymce.update');
    // route flash sale
    Route::get('panel/admin/flash-sale/fetch', [FlashSaleController::class, 'fetch'])->name('flash-sale.fetch');
    Route::get('panel/admin/flash-sale/get-product/{id}', [FlashSaleController::class, 'get_product'])->name('flash-sale.getProduct');
    Route::post('panel/admin/flash-sale/change-active', [FlashSaleController::class, 'change_active'])->name('flash-sale.changeActive');
    Route::post('panel/admin/flash-sale/change-feature', [FlashSaleController::class, 'change_feature'])->name('flash-sale.changeFeature');
    Route::post('panel/admin/flash-sale/destroy-selected', [FlashSaleController::class, 'destroy_selected'])->name('flash-sale.destroySelected');
    Route::post('panel/admin/flash-sale/destroy-soft/{id}', [FlashSaleController::class, 'destroy_soft'])->name('flash-sale.destroySoft');
    Route::resource('panel/admin/flash-sale', FlashSaleController::class);
    // route coupon
    Route::get('panel/admin/coupon/fetch', [CouponController::class, 'fetch'])->name('coupon.fetch');
    Route::post('panel/admin/coupon/change-active', [CouponController::class, 'change_active'])->name('coupon.changeActive');
    Route::post('panel/admin/coupon/destroy-selected', [CouponController::class, 'destroy_selected'])->name('coupon.destroySelected');
    Route::post('panel/admin/coupon/destroy-soft/{id}', [CouponController::class, 'destroy_soft'])->name('coupon.destroySoft');
    Route::resource('panel/admin/coupon', CouponController::class);
    // route homepage
    Route::get('panel/admin/homepage/fetch', [HomepageController::class, 'fetch'])->name('homepage.fetch');
    Route::post('panel/admin/homepage/change-active', [HomepageController::class, 'change_active'])->name('homepage.changeActive');
    Route::post('panel/admin/homepage/destroy-selected', [HomepageController::class, 'destroy_selected'])->name('homepage.destroySelected');
    Route::post('panel/admin/homepage/destroy-soft/{id}', [HomepageController::class, 'destroy_soft'])->name('homepage.destroySoft');
    Route::resource('panel/admin/homepage', HomepageController::class);
    // route sub oder
    Route::resource('panel/admin/order', OrderController::class);
});

Route::get('/', [HomeController::class, 'index']);
