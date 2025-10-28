<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SerttingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;

// -------------------- FRONTEND ROUTES --------------------
// Public pages (no login required)
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('store');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/productDetail/{id}', 'productDetail')->name('product.detail');
});

// Checkout & Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth')->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'checkoutPage'])->name('checkout.page');
Route::get('/checkout/confirm', [CheckoutController::class, 'checkoutConfirm']);
Route::post('/checkout/confirm', [CheckoutController::class, 'checkoutConfirm'])->name('checkout.confirm');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Order history
Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history')->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');

// For user contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// -------------------- AUTH ROUTES --------------------
// Login / Register page for guests only
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/auth/login', [LoginController::class, 'login'])->name('login');
    Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register');
});

// -------------------- LOGOUT --------------------
Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

// -------------------- ADMIN ROUTES --------------------
Route::middleware('role:1')->prefix('admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ⚙️ Security Settings
        Route::get('/settings/security', [SerttingController::class, 'securityForm'])->name('settings.security');
        Route::post('/settings/security', [SerttingController::class, 'updatePassword'])->name('settings.updatePassword');

        // Categories
        Route::prefix('categories')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });

        // Users
        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
        });

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{id}', [OrderController::class, 'show'])->name('show');
            Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::view('/settings', 'pages.settings')->name('settings');
});

// -------------------- USER ROUTES --------------------
Route::middleware(['auth', 'role:0'])->prefix('user')->group(function () {
    Route::get('/', function () {
        return view('pages.store');
    })->name('user.dashboard');
    // Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
