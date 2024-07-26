<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentCallbackController;

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

Route::get('/', [BerandaController::class,'beranda']);

Route::get('/beranda', [BerandaController::class,'beranda']);
Route::post('/beranda/bayar-photobooth', [BerandaController::class,'bayarPhotobooth'])->name('beranda.bayarPhotobooth');

// middleware(['auth'])->
Route::prefix('dashboard')->group(function () {
    Route::get('/',[DashboardController::class,'biayaPhotobooth'])->name('dashboard.biaya-photobooth');
    Route::post('update-biaya-photobooth',[DashboardController::class,'updateBiayaPhotobooth'])->name('dashboard.update-biaya-photobooth');
});

Route::get('create-order',[BerandaController::class,'createOrder'])->name('create-order');
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
