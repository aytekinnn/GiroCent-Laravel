<?php

use App\Http\Controllers\Backend\InstallmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\DefaultController;
use App\Http\Controllers\Backend\DefaultController as BackendDefaultController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\FeaturesController;
use App\Http\Controllers\Backend\ManufacturersController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\InformationsController;
use App\Http\Controllers\Backend\CampaignsController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Frontend\InstallmentController as FrontendInstallmentController;
use App\Http\Controllers\Backend\ExtraFeaturesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    Route::get('/',[DefaultController::class, 'index'])->name('home.frontend.index');
    Route::get('/belge-detay/{id}', [DefaultController::class, 'documentDetail'])->name('document.detail');
    Route::get('/giris', [DefaultController::class, 'login'])->name('login.front');
    Route::post('/giris', [DefaultController::class, 'auth'])->name('Login.Auth');
    Route::get('/cikis', [DefaultController::class, 'logout'])->name('logout.front');
    Route::get('/uye-ol', [DefaultController::class, 'register'])->name('register.front');
    Route::post('/uye-ol', [DefaultController::class, 'registerPost'])->name('register.post');
    Route::get('/search',[DefaultController::class, 'search'])->name('search.index');
    Route::get('/iletisim',[DefaultController::class, 'contact'])->name('iletisim.index');
    Route::post('/contact',[DefaultController::class, 'contactPost'])->name('contact.post');
    Route::get('/hakkimizda',[DefaultController::class, 'about'])->name('hakkimizda.index');
    Route::get('/faq',[DefaultController::class, 'faq'])->name('faq.index');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');


    Route::post('/checkout/create', [OrderController::class, 'create'])->name('checkout.create');
    Route::get('/checkout/complate', [OrderController::class, 'complate'])->name('checkout.complate');

    Route::prefix('product')->group(function () {
        Route::get('filter/{slug}', [ProductController::class, 'index'])->name('product.filter');
        Route::get('/search', [ProductController::class, 'search'])->name('product.search');
        Route::get('/detay/{slug}', [ProductController::class, 'detail'])->name('product.detail');
    });

    Route::get('/siparislerim', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/taksitlerim', [FrontendInstallmentController::class, 'index'])->name('installment.indexs');
Route::get('/taksitlerim-detay/views/{id}', [FrontendInstallmentController::class, 'viewer'])->name('installment.viewer');

Route::namespace('App\Http\Controllers\Backend')->group(function () {
    Route::prefix('tech')->group(function () {
        Route::get('/', [BackendDefaultController::class, 'index'])->name('home.index')->middleware('auth')->middleware('admin');
        Route::get('login',[BackendDefaultController::class, 'login'])->name('login');
        Route::post('login',[BackendDefaultController::class, 'authenticate'])->name('login.authenticate');
        Route::get('register',[BackendDefaultController::class, 'register'])->name('register');
        Route::post('register',[BackendDefaultController::class, 'store'])->name('register.store');
        Route::get('logout',[BackendDefaultController::class, 'logout'])->name('logout')->middleware('admin');
        Route::get('profile',[BackendDefaultController::class, 'profile'])->name('profile')->middleware('admin');
        Route::post('profile',[BackendDefaultController::class, 'update'])->name('profile.update')->middleware('admin');
    });

    Route::prefix('tech')->middleware('admin')->group(function () {
        $modules = [
            'category' => CategoryController::class,
            'features' => FeaturesController::class,
            'manufacturer' => ManufacturersController::class,
            'slider' => SlidersController::class,
            'informations' => InformationsController::class,
            'campaigns' => CampaignsController::class,
            'product' => BackendProductController::class,
            'order' => BackendOrderController::class,
            'installment' => InstallmentController::class,
            'extra-features' => ExtraFeaturesController::class,
        ];
        foreach ($modules as $prefix => $controller) {
            Route::prefix($prefix)->group(function () use ($controller, $prefix) {
                Route::get('/', [$controller, 'index'])->name("$prefix.index");
                Route::post('create', [$controller, 'create'])->name("$prefix.create");
                Route::get('delete/{id}', [$controller, 'destroy'])->name("$prefix.delete");
                Route::post('edit', [$controller, 'edit'])->name("$prefix.edit");
                Route::post('view', [$controller, 'view'])->name("$prefix.view");
            });
        }

        Route::prefix('product')->group(function () {
            Route::get('/get-feature',[BackendProductController::class, 'getFeature'])->name('product.get-feature');
            Route::get('/get-extra-feature',[BackendProductController::class, 'getExtraFeature'])->name('product.get-feature');
            Route::get('store', [BackendProductController::class, 'store'])->name('product.store');
            Route::get('edit-view/{id}',[BackendProductController::class, 'editView'])->name('product.edit-view');
            Route::get('gallery/{id}', [GalleryController::class, 'gallery'])->name('portfolyoGallery');
            Route::post('delete-images', [GalleryController::class, 'delete'])->name('gallery.delete');
            Route::get('gallery-add/{id}', [GalleryController::class, 'galleryadd'])->name('gallery.add');
            Route::post('upload-image', [GalleryController::class, 'uploadImage'])->name('gallery.upload');
        });

        Route::prefix('order')->group(function () {
            Route::get('edit/{id}',[BackendOrderController::class, 'editView'])->name('order.edit-view');
        });

        Route::get('installment/views/{id}', [InstallmentController::class, 'views'])->name('installment.views');
    });
});
