<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/articolo/{id}', [FrontController::class, 'create'])->name('home.create');

require __DIR__.'/auth.php';
