<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController; // For non-admin comments
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController; // Alias for admin comments
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AccountController;

Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/map', [PageController::class, 'map'])->name('map');
Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/festivals/{id}', [FestivalController::class, 'show'])->name('festivals.show');
Route::middleware(['auth', 'admin'])->group(function () {
    // Add Festival
    Route::get('/festivals/create', [FestivalController::class, 'create'])->name('festivals.create');
    Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');

    // Edit Festival
    Route::get('/festivals/{id}/edit', [FestivalController::class, 'edit'])->name('festivals.edit');
    Route::patch('/festivals/{id}', [FestivalController::class, 'update'])->name('festivals.update');

    // Delete Festival
    Route::delete('/festivals/{id}', [FestivalController::class, 'destroy'])->name('festivals.destroy');
});

Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Non-admin comment routes
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::post('/users/{user}/demote-admin', [UserController::class, 'demoteAdmin'])->name('users.demoteAdmin');

    // Admin comment routes
    Route::patch('/comments/{comment}', [AdminCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::delete('/admin/contacts/{contact}', [AdminController::class, 'destroyContact'])->name('admin.contacts.destroy');

Route::middleware(['auth'])->group(function () {
    Route::post('/favorites/{festival}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{festival}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');
    Route::post('/account/settings', [AccountController::class, 'update'])->name('account.update');
});