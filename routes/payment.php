<?php

use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\ReservationController;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:api'])->prefix('reservation')->group(function () {
//     Route::post('', [ReservationController::class, 'createReservation']);
//     Route::post('confirm', [ReservationController::class, 'confirmReservation']);
//     Route::get('forUser', [ReservationController::class, 'getReservationForUser']);

//     Route::middleware(['scopes:company'])->group(function () {
//         Route::get('forCompany', [ReservationController::class, 'getReservationForCompany']);
//     });
// });

// Route::middleware(['auth:api', 'scopes:admin'])->group(function () {
//     Route::post('deposit', [PaymentController::class, 'deposit']);
//     Route::post('withdraw', [PaymentController::class, 'withdraw']);
//     Route::get('', [PaymentController::class, 'getPayment']);
// });
