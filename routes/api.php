<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CountryController,
    WarehouseController,
    ProductController,
    SupplierController,
    InventoryTransactionController,
    InventoryController,
    ReportController
};

Route::get('/ping', fn() => response()->json(['status' => 'API working']));
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // All your protected routes here
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('warehouses', WarehouseController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('inventories', InventoryController::class);

    Route::post('/inventory-transactions', [InventoryTransactionController::class, 'store']);
    Route::post('/inventory-transfer', [InventoryController::class, 'transfer']);
    Route::get('/inventory/global-view', [InventoryController::class, 'globalView']);
    Route::get('/reports/low-stock', [ReportController::class, 'lowStock']);
    Route::get('/inventory/report', [InventoryTransactionController::class, 'report']);
});
