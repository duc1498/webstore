<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;



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

Auth::routes([
    'register' => false,
    'reset' => false
]);


Route::get('/', [HomesController::class, 'index'])->name('homes.index');
Route::get('contact', [ContactController::class, 'contact'])->name('contact.index');
Route::post('contacts', [HomesController::class, 'contactPost'])->name('contactPost');
Route::get('introduce',[HomesController::class, 'introduce'])->name('introduce');
Route::get('articles',[HomesController::class, 'articles'])->name('articles');
Route::get('articles/{slug}', [HomesController::class, 'detailArticle'])->name('detail-article');
Route::get('/danh-muc/{category}', [HomesController::class, 'category'])->name('category');
Route::get('/lien-he', [HomesController::class, 'contact'])->name('contact');
Route::get('/chi-tiet-san-pham/{product}', [HomesController::class, 'product'])->name('product');
Route::get('/tim-kiem', [HomesController::class, 'search'])->name('search');
Route::get('/gio-hang', [HomesController::class, 'cart'])->name('cart');


Route::get('cart', [HomesController::class, 'cart'])->name('cart.list');
Route::post('cart', [HomesController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [HomesController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [HomesController::class, 'removeCart'])->name('cartRemove');
Route::post('clear', [HomesController::class, 'clearAllCart'])->name('cart.clear');


Route::post('/checkout', [HomesController::class, 'checkout'])->name('checkout.process');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/test', [BannerController::class, 'test']);
    Route::resource('product', ProductController::class);
    Route::resource('banner', BannerController::class);
        Route::post('banner/restore/{id}',[BannerController::class,'restore'])->name('banner.restore');
        Route::get('/exportCsv',[BannerController::class,'export'])->name('banner.export');
        Route::post('/importCsv',[BannerController::class,'import'])->name('banner.import');

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

Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
    Route::get('/reset', [ForgotPasswordController::class, 'index'])->name('forgot');
    Route::post('/email', [ForgotPasswordController::class, 'sendMailReset'])->name('email');
    Route::get('/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('reset');
    Route::post('/update', [ForgotPasswordController::class, 'update'])->name('update');
});
Route::post('/vnpay', [HomesController::class, 'getPayment'])->name('getPayment');
// Auth::routes();
// Route::get('/', [HomeController::class, 'index'])->name('home');
