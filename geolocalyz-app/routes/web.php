<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController; 

Route::get('/', function () {
    return view('home');
});

Route::get('/add-number', [StepController::class, 'index'])->name('addNumber');

Route::get('/search-number', [StepController::class, 'searchNumber'])->name('searchNumber');

Route::get('/add-email', [StepController::class, 'addEmail'])->name('addEmail');

Route::get('/payment-geolocalyz', [StepController::class, 'PreparePayment'])->name('PreparePayment');