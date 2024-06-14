<?php

use App\Http\Controllers\Client\BranchController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\ConfigController;
use App\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/user', [UserController::class, 'index'])->middleware('auth:api');


// Route::prefix('/user')->group(function () {
//     Route::post('/sign-up', [UserController::class, 'signUp']);
//     Route::post('/sign-in', [UserController::class, 'signIn']);
//     Route::middleware('auth:api')->group(function () {
//         Route::get('/', [UserController::class, 'getUser']);
//         Route::post('/update', [UserController::class, 'updateUser']);
//     });
//     Route::middleware(['auth:api', 'scopes:admin'])->group(function () {
//         Route::get('/all', [UserController::class, 'getAllUsers']);
//     });
// });

// Route::prefix('/config')->group(function () {
//     Route::get('', [ConfigController::class, 'getConfig']);
// });


// Route::prefix('/company')->middleware('auth:api')->group(function () {
//     Route::post('', [CompanyController::class, 'create']);

//     Route::get('', [CompanyController::class, 'getCompany']);
//     Route::middleware([ 'scopes:company'])->group(function () {
//         Route::post('/update', [CompanyController::class, 'update']);
//         Route::prefix('/branch')->group(function () {
//             Route::post('', [BranchController::class, 'create']);
//             Route::delete('', [BranchController::class, 'delete']);
//         });
//     });
//     //Route::middleware(['auth:api', 'scopes:admin'])->group(function () {
//         Route::get('/all', [CompanyController::class, 'getAllcompanies']);
//     //});
// });
