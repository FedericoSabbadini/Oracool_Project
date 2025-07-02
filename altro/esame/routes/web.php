<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HotelController;

Route::get('/', [FrontController::class, 'index'])->name('login');
Route::get('/home', [FrontController::class, 'home'])->name('home');
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');
Route::post('/hotel/store', [HotelController::class, 'store'])->name('hotel.store');


require __DIR__.'/auth.php';
