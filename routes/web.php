<?php

use App\Http\Controllers\FoodController;
use App\Models\Food;
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

Route::get('/foods/create', [FoodController::class, 'create']);
Route::get('/', [FoodController::class, 'index'])->name('food.index');
Route::post('/foods/create', [FoodController::class, 'store'])->name('food.store');
