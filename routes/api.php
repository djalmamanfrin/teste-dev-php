<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::prefix('suppliers')
    ->middleware('api')
    ->group(function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('{supplier}', [SupplierController::class, 'show']);
        Route::put('{supplier}', [SupplierController::class, 'update']);
        Route::delete('{supplier}', [SupplierController::class, 'destroy']);
    });
