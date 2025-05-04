<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\FestivalController;


Route::get('/', [PageController::class, 'home'])->name('home');



Route::get('/festivals/create', [FestivalController::class, 'create'])->name('festivals.create');
Route::get('/map', [PageController::class, 'map'])->name('map');
Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/festivals/{id}', [FestivalController::class, 'show'])->name('festivals.show');


Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');
