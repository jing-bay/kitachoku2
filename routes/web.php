<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingsUserController;
use App\Http\Controllers\SettingsShopController;
use App\Http\Controllers\SettingsAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchUserController;
use App\Http\Controllers\SearchShopAdminController;
use App\Http\Controllers\SearchShopController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SearchReservationController;
use App\Http\Controllers\NoticeController;

Route::get('/', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/detail/{shop_id}', [SearchController::class, 'show']);

Route::middleware(['auth'])->group(function (){
    Route::post('/favorite', [FavoriteController::class, 'store']);
    Route::post('/favorite/delete/{favorite_id}', [FavoriteController::class, 'destroy']);
    Route::post('/evaluation', [EvaluationController::class, 'store']);
    Route::post('/evaluation/update/{evaluation_id}', [EvaluationController::class, 'update']);
    Route::post('/evaluation/delete/{evaluation_id}', [EvaluationController::class, 'destroy']);
    Route::post('/reservation', [ReservationController::class, 'store']);
    Route::get('/resavation-thanks', [ReservationController::class, 'show']);
    Route::post('/reservation/update/{reservation_id}', [ReservationController::class, 'update']);
    Route::post('/reservation/delete/{reservation_id}', [ReservationController::class, 'destroy']);
    Route::get('/settings-user', [SettingsUserController::class, 'index']);
});

Route::middleware(['auth:shopadmin'])->group(function (){
    Route::get('/settings-shop', [SettingsShopController::class, 'index']);
    Route::post('/shop', [ShopController::class, 'store']);
    Route::post('/coupon', [CouponController::class, 'store']);
    Route::post('/coupon/update/{coupon_id}', [CouponController::class, 'update']);
    Route::post('/coupon/delete/{coupon_id}', [CouponController::class, 'destroy']);
    Route::get('/reservation/search', [SearchReservationController::class, 'search']);
});

Route::middleware(['auth:admin'])->group(function (){
    Route::get('/settings-admin', [SettingsAdminController::class, 'index']);
    Route::post('/admin/update/{admin_id}', [AdminController::class, 'update']);
    Route::post('/admin/delete/{admin_id}', [AdminController::class, 'destroy']);
    Route::get('/search/user', [SearchUserController::class, 'search']);
    Route::get('/search/shopadmin', [SearchShopAdminController::class, 'search']);
    Route::get('/search/shop', [SearchShopController::class, 'search']);
    Route::get('/search/shopadmin/detail/{shop_id}', [SearchShopController::class, 'show']);
    Route::post('/notice', [NoticeController::class, 'store']);
    Route::post('/notice/delete/{notice_id}', [NoticeController::class, 'destroy']);
});

Route::middleware(['auth:shopadmin', 'auth:admin'])->group(function (){
    Route::post('/shopadmin/update/{shop_admin_id}', [ShopAdminController::class, 'update']);
    Route::post('/shopadmin/delete/{shop_admin_id}', [ShopAdminController::class, 'destroy']);
    Route::post('/shop/update/{shop_id}', [ShopController::class, 'update']);
    Route::post('/shop/delete/{shop_id}', [ShopController::class, 'destroy']);
});

Route::middleware(['auth', 'auth:admin'])->group(function (){
    Route::post('/user/update/{user_id}', [UserController::class, 'update']);
    Route::post('/user/delete/{user_id}', [UserController::class, 'destroy']);
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});

Route::prefix('shop-admin')->name('shop-admin.')->group(function(){
    require __DIR__.'/shopadmin.php';
});
