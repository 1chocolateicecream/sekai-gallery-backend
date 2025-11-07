<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes
Route::prefix('v1')->group(function () {
    Route::get('/images', [AssetController::class, 'index']);
});
