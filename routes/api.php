<?php

use App\Http\Controllers\CustomerController;
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

Route::prefix('/customer')->name('customer.')->group(function() {
    Route::get('/list', [CustomerController::class, 'list'])->name('list');
    Route::post('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/bulk-create', [CustomerController::class, 'bulkCreate'])->name('bulkcreate');
    Route::post('/update', [CustomerController::class, 'update'])->name('update');
    Route::post('/bulk-update', [CustomerController::class, 'bulkUpdate'])->name('bulkupdate');
});
