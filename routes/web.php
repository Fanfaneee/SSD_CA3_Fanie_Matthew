<?php

use App\Http\Controllers\PageController;


Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/festivals', [PageController::class, 'festivals'])->name('festivals');


Route::get('/map', [PageController::class, 'map'])->name('map');
Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

