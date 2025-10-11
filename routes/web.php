<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
Route::view('/product', 'pages.product')->name('product');
Route::view('/users', 'pages.users')->name('users');
Route::view('/settings', 'pages.settings')->name('settings');
Route::view('/store', 'pages.store')->name('store');
Route::view('/logout', 'layouts.app')->name('logout');