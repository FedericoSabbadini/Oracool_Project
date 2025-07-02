<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\ViewController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');

Route::get('/loadPage', [LoadController::class, 'create'])->name('load.create');
Route::post('/loadPageStore', [LoadController::class, 'store'])->name('load.store');

Route::get('/viewPage', [ViewController::class, 'create'])->name('view.create');

require __DIR__.'/auth.php';
