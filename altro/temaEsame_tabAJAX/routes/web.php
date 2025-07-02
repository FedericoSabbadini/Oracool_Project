<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AjaxController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');

Route::get('/previous', [AjaxController::class, 'previous'])->name('ajax.previous');
Route::get('/next', [AjaxController::class, 'next'])->name('ajax.next');
Route::post('/store', [AjaxController::class, 'store'])->name('home.store');

require __DIR__.'/auth.php';
