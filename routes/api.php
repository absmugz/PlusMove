<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PackageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protect routes with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
    // City Routes
    Route::apiResource('cities', CityController::class);

    // Delivery Routes (Assigning drivers with minimal load)
    Route::post('/deliveries/assign', [DeliveryController::class, 'assignDelivery']);

    Route::post('/deliveries', [DeliveryController::class, 'store']);
    Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy']);
    // Package Routes (Multiple packages per delivery)
    Route::apiResource('packages', PackageController::class);
    
    });

    // Driver-only routes
    Route::middleware('role:driver')->group(function () {
        Route::patch('/deliveries/{id}/update-status', [DeliveryController::class, 'update']);
    });

    // Customer-only routes
    Route::middleware('role:customer')->group(function () {
        Route::get('/deliveries', [DeliveryController::class, 'index']);
        Route::get('/deliveries/{id}', [DeliveryController::class, 'show']);
    });
});





