<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/store', [FrontController::class, 'store'])->name('home.store');
Route::get('/delete', [FrontController::class, 'delete'])->name('home.delete');
Route::get('/create', [FrontController::class, 'create'])->name('home.create');


require __DIR__.'/auth.php';
