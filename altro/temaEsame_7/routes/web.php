<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewController;

Route::get('/', [FrontController::class, 'index'])->name('home.index');
Route::get('/view', [ViewController::class, 'create'])->name('create.view');
Route::get('/admin', [AdminController::class, 'create'])->name('create.admin');
Route::post('/adminStore', [AdminController::class, 'store'])->name('store.admin');



require __DIR__.'/auth.php';
