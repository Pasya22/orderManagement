<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', [OrderController::class, 'index'])->name('Home');
Route::get('/bill', [BillController::class, 'showBillForm']);
Route::post('/bill', [BillController::class, 'showBill']);
    