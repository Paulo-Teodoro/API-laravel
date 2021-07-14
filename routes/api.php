<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1'
], function () {
    Route::get('/categories/{id}/products', [CategoryController::class, 'products']);

    Route::apiResource('/categories', CategoryController::class);
    
    Route::apiResource('/products', ProductController::class);
});

/*
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
