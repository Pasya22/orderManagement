<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillController;

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
Route::post('/order', [OrderController::class, 'store'])->name('orders');
Route::get('/bill/{table_no}', [BillController::class, 'getBill']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
