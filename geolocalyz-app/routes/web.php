<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController; 

Route::get('/', function () {
    return view('home');
});

Route::get('/add-number', [StepController::class, 'index'])->name('addNumber');

Route::get('/search-number', [StepController::class, 'searchNumber'])->name('searchNumber');