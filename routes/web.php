<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAssetController;

Route::get('/', function () {
    return view('welcome');
});

// Protected admin routes
$secret = config('app.admin_secret');

Route::prefix($secret)->middleware('secret.admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('assets.index');
    });
    Route::resource('assets', AdminAssetController::class);
});
