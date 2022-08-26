<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BrandController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('homes', [HomesController::class, 'index'])->name('homes.index');
Route::get('contact', [ContactController::class, 'contact'])->name('contact.index');
Route::post('contacts', [HomesController::class, 'contactPost'])->name('contactPost');
Route::get('introduce',[HomesController::class, 'introduce'])->name('introduce');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/test', [BannerController::class, 'test']);
    Route::resource('product', ProductController::class);
    Route::resource('banner', BannerController::class);
        Route::post('banner/restore/{id}',[BannerController::class,'restore'])->name('banner.restore');

    Route::resource('category', CategoryController::class);
        Route::post('category/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');

    Route::resource('article', ArticleController::class);
        Route::post('article/restore/{id}',[ArticleController::class,'restore'])->name('article.restore');

    Route::resource('setting', SettingController::class);
    Route::resource('contact', ContactController::class);

        Route::post('contact/restore/{id}',[ContactController::class,'restore'])->name('contact.restore');
    Route::resource('user', UserController::class);

    Route::resource('vendor', VendorController::class);
        Route::post('Vendor/restore/{id}',[VendorController::class,'restore'])->name('vendor.restore');

    Route::resource('brand', BrandController::class);
        Route::post('Brand/restore/{id}',[BrandController::class,'restore'])->name('brand.restore');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
