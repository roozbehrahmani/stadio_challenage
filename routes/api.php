<?php

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\VendingMachineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('vending-machine', [VendingMachineController::class, 'store'])->name('store');
Route::get('/purchase', [PurchaseController::class, 'index'])->name('index');
Route::post('/purchase', [PurchaseController::class, 'store'])->name('store');
