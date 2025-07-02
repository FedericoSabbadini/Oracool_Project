<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ArticoloController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/autoriArticolo', [ArticoloController::class, 'showAutori'])->name('home.autori');

require __DIR__.'/auth.php';
