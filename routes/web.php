<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalPaymentController;

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
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/books/category/{category}', [FrontController::class, 'getBooksByCategory'])->name('category.books');

Auth::routes();

Route::get('/activate/{code}', [ActivationController::class, 'activateUserAccount'])->name('users.activate');
Route::get('/resend/{email}', [ActivationController::class, 'resendActivationCode'])->name('users.resendcode');

Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('cart', CartController::class);
Route::resource('orders', OrderController::class);
// Payement Routes
Route::get('/handle-payment', [PaypalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('/success-payment', [PaypalPaymentController::class, 'paymentSuccess'])->name('success.payment');
Route::get('/cancel-payment', [PaypalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
// Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/login', [AdminController::class, 'adminLoginForm'])->name('admin.form')->middleware('guest:admin');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
