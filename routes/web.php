<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\ContractorsController;
use App\Http\Controllers\front\OverflowMaterialController;
use App\Http\Controllers\front\WorkController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WhatsAppController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Home route
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //contractors route
    Route::get('/contractor', [ContractorsController::class, 'index'])->name('contractors.index');
    //how Works route
    Route::get('/work', [WorkController::class, 'index'])->name('works.index');

    Route::resource('/materials', OverflowMaterialController::class);
    Route::post('/materials', [OverflowMaterialController::class, 'store'])->name('overflow.store');

    Route::get('/send-whatsapp/{phone}/{message}', [WhatsAppController::class, 'sendWhatsApp'])->name('whatsapp');
});


Route::get('/payment', [PaymentController::class, 'index'])->name('payment');

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
