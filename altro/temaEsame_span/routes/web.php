<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotiController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::post('/storeVoto', [VotiController::class, 'store'])->name('home.store');
Route::get('/checkVoto', [VotiController::class, 'check'])->name('home.check');


require __DIR__.'/auth.php';
