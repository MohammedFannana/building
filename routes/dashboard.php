<?php

use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\OverflowMaterialController;
use App\Http\Controllers\dashboard\ProviderController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\dashboard\WorkController;

Route::middleware(['auth', 'can:dashboard_access'])->as('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->middleware(['verified'])->name('dashboard');

    Route::resource('/user', UserController::class);
    Route::resource('/provider', ProviderController::class);
    Route::resource('/admin', AdminController::class);
    Route::resource('/service', ServiceController::class);
    Route::resource('/work', WorkController::class);
    Route::resource('/material', OverflowMaterialController::class);
    Route::post('/freePeriod', [UserController::class, 'freePeriod'])->name('free.period');
});
