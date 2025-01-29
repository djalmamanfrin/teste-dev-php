<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::prefix('suppliers')
    ->middleware('api')
    ->group(function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('{id}', [SupplierController::class, 'show']);
        Route::put('{id}', [SupplierController::class, 'update']);
        Route::delete('{id}', [SupplierController::class, 'destroy']);
    });
