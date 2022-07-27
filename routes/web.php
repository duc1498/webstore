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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('contact', [ContactController::class, 'contact'])->name('contact.index');
Route::post('contact', [HomeController::class, 'contactPost'])->name('contactPost');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/test', [BannerController::class, 'test']);
    Route::resource('product', ProductController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('user', UserController::class);
});









