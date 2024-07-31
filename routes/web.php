<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\AuthController::class, 'index']);

Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'verify'])->name('auth.verify');


Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile',[App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password',[App\Http\Controllers\DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password',[App\Http\Controllers\DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

        Route::get('/publisher', [App\Http\Controllers\PublisherController::class, 'index'])->name('publisher.index');
        Route::get('/publisher/create', [App\Http\Controllers\PublisherController::class, 'create'])->name('publisher.create');
        Route::post('/publisher/store', [App\Http\Controllers\PublisherController::class, 'store'])->name('publisher.store');
        Route::get('/publisher/destroy/{id}', [App\Http\Controllers\PublisherController::class, 'destroy'])->name('publisher.destroy');
        Route::get('/publisher/edit/{id}', [App\Http\Controllers\PublisherController::class, 'edit'])->name('publisher.edit');
        Route::post('/publisher/update', [App\Http\Controllers\PublisherController::class, 'update'])->name('publisher.update');

        Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');
        Route::get('/book/create', [App\Http\Controllers\BookController::class, 'create'])->name('book.create');
        Route::post('/book/store', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');
        Route::get('/book/destroy/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('book.destroy');
        Route::get('/book/edit/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');
        Route::post('/book/update', [App\Http\Controllers\BookController::class, 'update'])->name('book.update');

        Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
        Route::post('/customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::get('/customer/destroy/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');
        Route::get('/customer/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/customer/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');


        Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/transaction/detail/{id}', [App\Http\Controllers\TransactionController::class, 'detail'])->name('transaction.detail');
        Route::get('/transaction/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transaction.create');
        Route::post('/transaction/store', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
        Route::post('/transaction/return', [App\Http\Controllers\TransactionController::class, 'return'])->name('transaction.return');

    });

    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
});
