<?php

//use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
*/

Route::get('/', [FrontController::class, 'getHome'])->name('home');
Route::resource('book', BookController::class);
// Placeholder for:
// - Route::get('/book', [BookController::class, 'index'])->name('book.index'); // Display the list of books
// - Route::get('/book/create', [BookController::class, 'create'])->name('book.create'); // Display the creation form
// - Route::post('/book', [BookController::class, 'store'])->name('book.store'); // Save the book in DB
// - Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show'); // Display the a single book
// - Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit'); // Display the edit form
// - Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update'); // Update the book in DB
// - Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy'); // Delete the book from ID
Route::get('/book/{id}/destroy/confirm', [BookController::class, 'confirmDestroy'])->name('book.destroy.confirm');

Route::resource('author', AuthorController::class);
Route::get('/author/{id}/destroy/confirm', [AuthorController::class, 'confirmDestroy'])->name('author.destroy.confirm');
