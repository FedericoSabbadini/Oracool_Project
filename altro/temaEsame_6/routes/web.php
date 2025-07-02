<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/activity/create', [FrontController::class, 'create'])->name('activity.create');
Route::post('/activity/store', [FrontController::class, 'store'])->name('activity.store');
Route::get('/home/ajax', [FrontController::class, 'ajaxActivities'])->name('home.ajax');

require __DIR__.'/auth.php';
