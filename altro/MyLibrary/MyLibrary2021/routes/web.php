<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['lang'])->group(function () {
    Route::get('/', [FrontController::class, 'getHome'])->name('home');
    Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');
    Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login');
    Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
    Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
});

Route::middleware(['authCustom','lang'])->group(function () {
    //From Laravel 8: Route::resource('book', BookController::class);
    Route::resource('book', BookController::class);
    Route::get('/book/{id}/destroy', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/{id}/destroy/confirm', [BookController::class, 'confirmDestroy'])->name('book.destroy.confirm');
    Route::get('/book/{id}/update', [BookController::class, 'update'])->name('book.update');

    //From Laravel 8: Route::resource('author', AuthorController::class);
    Route::resource('author', AuthorController::class);
    Route::get('/author/{id}/destroy', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::get('/author/{id}/destroy/confirm', [AuthorController::class, 'confirmDestroy'])->name('author.destroy.confirm');
    Route::get('/author/{id}/update', [AuthorController::class, 'update'])->name('author.update');

    Route::get('/ajax', [AuthorController::class, 'ajaxCheckForAuthors']);
    Route::get('/ajaxBook', [BookController::class, 'ajaxCheckForBooks']);
});