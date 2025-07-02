<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OperationalController;
use App\Http\Controllers\EditController;


Route::get('/', [FrontController::class, 'index'])->name('home.index');

Route::get('transactions/create', [OperationalController::class, 'create'])
    ->name('transactions.create');
Route::post('transactions', [OperationalController::class, 'store'])
    ->name('transactions.store');

Route::get('transactions/{transaction}/show', [EditController::class, 'show'])
    ->name('transactions.show');
Route::post('transactions/update', [EditController::class, 'update'])
    ->name('transactions.update');
Route::get('transactions/{transaction}', [EditController::class, 'destroy'])
    ->name('transactions.destroy');

require __DIR__.'/auth.php';
