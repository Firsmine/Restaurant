<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\TransactionController;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('tables', [RestaurantTableController::class, 'index']);

    // menu items
    Route::get('menu-items', [MenuItemsController::class, 'index']);
    Route::post('menu-items', [MenuItemsController::class, 'store']);
    Route::put('menu-items/{id}', [MenuItemsController::class, 'update']);
    Route::get('menu-items/{id}', [MenuItemsController::class, 'show']);
    Route::delete('menu-items/{id}', [MenuItemsController::class, 'destroy']);

    // transaction
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::post('transactions', [TransactionController::class, 'store']);
    Route::get('transactions/{id}', [TransactionController::class, 'show']);
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy']);

    // order
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::delete('orders/{id}', [OrderController::class, 'destroy']);

    // order detail
    Route::get('order-details', [OrderDetailController::class, 'index']);
    Route::post('order-details', [OrderDetailController::class, 'store']);
    Route::get('order-details/{transactionId}', [OrderDetailController::class, 'show']);
    Route::delete('order-details/{id}', [OrderDetailController::class, 'destroy']);
});
