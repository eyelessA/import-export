<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ExcelController::class, 'index']);
Route::post('/', [ExcelController::class, 'upload']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
