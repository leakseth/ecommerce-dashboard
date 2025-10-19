<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

// -------------------- DEFAULT PAGE --------------------
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role == 1
            ? redirect()->route('dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login.form');
});

// -------------------- GUEST ROUTES --------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

// -------------------- AUTH ROUTES --------------------
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

        // Optional pages
        Route::view('/orders', 'pages.orders')->name('orders');
        Route::view('/settings', 'pages.settings')->name('settings');
    });

    // -------------------- USER ROUTES --------------------
    Route::middleware('role:0')->prefix('user')->group(function () {
        Route::get('/', function () {
            return view('pages.store');
        })->name('user.dashboard');
    });
});
