<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'suppliers'], function () {
    Route::get('/', [SupplierController::class, 'index']);
    Route::get('/{supplier}', [SupplierController::class, 'show']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::put('/{supplier}', [SupplierController::class, 'update']);
    Route::patch('/{supplier}', [SupplierController::class, 'update']);
    Route::delete('/{supplier}', [SupplierController::class, 'destroy']);
});
