<?php

use App\Models\Food;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;

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

//  FOODS : GET
Route::get('/foods/create', [FoodController::class, 'create']);
Route::get('/', [FoodController::class, 'index'])->name('food.index');
Route::get('/search', [FoodController::class, 'search'])->name('food.search');
Route::get('/foods/{id}', [FoodController::class, 'show'])->name('food.show');

// FOODS : POST
Route::post('/foods/create', [FoodController::class, 'store'])->name('food.store');

// TRANSACTION : GET
Route::get('/checkout/{id}', [TransactionController::class, 'checkout'])->name('checkout');
Route::get('/transaction/{id}/success', [TransactionController::class, 'success'])->name('transaction.success');
Route::get('/transaction/{id}/failed', [TransactionController::class, 'failed'])->name('transaction.failed');

// TRANSACTION : POST
Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');

// TRANSACTION : PATCH
Route::patch('/transaction/{id}/update', [TransactionController::class, 'update'])->name('transaction.update');

// CARTS : GET
Route::get('/carts/show', [CartController::class, 'show'])->name('cart.show');

// CARTS : POST
Route::post('/carts/add', [CartController::class, 'store'])->name('cart.add');

// CARTS : PATCH
Route::patch('/carts', [CartController::class, 'update'])->name('cart.update');

// DASHBOARD : GET
Route::get('/dashboard/home', [AdminController::class, 'home'])->name('dashboard.home');
Route::get('/dashboard/menus', [AdminController::class, 'menu'])->name('dashboard.menus');
Route::get('/dashboard/menus/checkout/{id}', [AdminController::class, 'checkout'])->name('dashboard.menus.checkout');
