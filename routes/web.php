<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserController;


Route::get('/', [PageController::class, 'home'])->name('home');



Route::get('/festivals/create', [FestivalController::class, 'create'])->name('festivals.create');
Route::get('/map', [PageController::class, 'map'])->name('map');
Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/festivals/{id}', [FestivalController::class, 'show'])->name('festivals.show');


Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::post('/users/{user}/demote-admin', [UserController::class, 'demoteAdmin'])->name('users.demoteAdmin');
});