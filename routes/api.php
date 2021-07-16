<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Auth\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/auth', [AuthApiController::class, 'authenticate'])->name('auth.authenticate');
Route::post('auth-refresh', [AuthApiController::class, 'refreshToken'])->name('auth.refreshToken');
Route::get('/user', [AuthApiController::class, 'getAuthenticatedUser'])->name('auth.getAuthenticatedUser');

Route::group([
    'prefix'     => 'v1',
    //'middleware' => 'jwt.auth' OR
    'middleware' => 'auth'
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
