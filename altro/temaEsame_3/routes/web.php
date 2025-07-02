<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::post('/storeVoto', [FrontController::class, 'store'])->name('home.store');
Route::get('/ajax', [FrontController::class, 'ajax'])->name('home.ajax');

require __DIR__.'/auth.php';
