<?php

use App\Http\Controllers\Api\ContractorsController;
use App\Http\Controllers\Api\OverflowMaterialController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('service', [ServiceController::class, 'index']);
Route::post('detail/service/{id}', [ContractorsController::class, 'show']);
Route::apiResource('overflow/materials', OverflowMaterialController::class);
Route::get('profile', [ProfileController::class, 'show']);
Route::put('profile/{id}', [ProfileController::class, 'update']);
Route::get('cities', [CityController::class, 'index'])->name('cities');
Route::get('career', [CityController::class, 'getCareer'])->name('career');
