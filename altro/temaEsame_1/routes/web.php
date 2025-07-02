<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CreateController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/students/edit', [EditController::class, 'edit'])->name('home.edit');
Route::post('/students/update', [EditController::class, 'update'])->name('home.update');

Route::get('/students/create', [CreateController::class, 'create'])->name('home.create');
Route::post('/students/store', [CreateController::class, 'store'])->name('home.store');

Route::get('/students/next', [AjaxController::class, 'next'])->name('home.next');
Route::get('/students/unique', [AjaxController::class, 'unique'])->name('home.unique');




