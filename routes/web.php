<?php

use App\Models\Food;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
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

Route::get('/foods/create', [FoodController::class, 'create']);
Route::get('/', [FoodController::class, 'index'])->name('food.index');
Route::get('/foods/{id}', [FoodController::class, 'show'])->name('food.show');

Route::post('/foods/create', [FoodController::class, 'store'])->name('food.store');

Route::get('/checkout/{id}', [TransactionController::class, 'checkout'])->name('checkout');

Route::post('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::get('/transaction/success', function () {
    return view('transaction.success');
})->name('transaction.success');

Route::post('/carts/add', [CartController::class, 'store'])->name('cart.add');
Route::get('/carts/show', [CartController::class, 'show'])->name('cart.show');
Route::patch('/carts', [CartController::class, 'update'])->name('cart.update');
