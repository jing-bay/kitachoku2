<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchShopController;
use App\Http\Controllers\SearchCalendarController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SettingsAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NoticeController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/search', [SearchShopController::class, 'search']);
Route::get('/detail/{shop_id}', [SearchShopController::class, 'show'])->name('detail.show');
Route::get('/search/calendar', [SearchCalendarController::class, 'search']);
Route::get('/search/calendar/{user_id}', [SearchCalendarController::class, 'show']);
Route::get('/user/destroy/withdraw', [UserController::class, 'show']);
Route::get('/send-thanks', [UserController::class, 'showSend']);
Route::get('/admin/destroy/withdraw', [AdminController::class, 'show']);
Route::get('/admin/send-thanks', [AdminController::class, 'showSend']);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::post('/favorite', [FavoriteController::class, 'store']);
    Route::post('/favorite/destroy/{favorite_id}', [FavoriteController::class, 'destroy']);
    Route::get('/search/favorite', [FavoriteController::class, 'search']);
    Route::get('/register-thanks', [UserController::class, 'showThanks']);
    Route::post('/calendar', [CalendarController::class, 'store']);
    Route::get('/calendar/{shop_id}', [CalendarController::class, 'create']);
    Route::post('/calendar/update/{calendar_id}', [CalendarController::class, 'update']);
    Route::get('/calendar/update/{calendar_id}', [CalendarController::class, 'edit']);
    Route::post('/calendar/destroy/{calendar_id}', [CalendarController::class, 'destroy']);
});

Route::middleware(['auth:admin', 'verified'])->group(function (){
    Route::get('/search/shop', [SearchShopController::class, 'searchAdmin']);
    Route::get('/admin/settings', [SettingsAdminController::class, 'index']);
    Route::get('/admin/settings/user/{user_id}', [SettingsAdminController::class, 'editUser']);
    Route::get('/search/user', [UserController::class, 'search']);
    Route::post('/admin/update', [AdminController::class, 'update']);
    Route::post('/admin/destroy', [AdminController::class, 'destroy']);
    Route::get('/admin/register-thanks', [AdminController::class, 'showThanks']);
    Route::post('/notice', [NoticeController::class, 'store']);
    Route::post('/notice/destroy/{notice_id}', [NoticeController::class, 'destroy']);
    Route::post('/shop/destroy/{shop_id}', [ShopController::class, 'destroy']);
});

Route::middleware(['auth:web,admin', 'verified'])->group(function (){
    Route::post('/user/update', [UserController::class, 'update']);
    Route::post('/user/destroy', [UserController::class, 'destroy']);
    Route::post('/shop', [ShopController::class, 'store']);
    Route::get('/shop', [ShopController::class, 'create']);
    Route::get('/shop/edit/{shop_id}', [ShopController::class, 'edit']);
    Route::post('/shop/update/{shop_id}', [ShopController::class, 'update']);
    Route::get('/shop/done', [ShopController::class, 'show']);
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});