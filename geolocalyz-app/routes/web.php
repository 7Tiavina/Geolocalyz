<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController; 

Route::get('/', function () {
    return view('home');
});

Route::get('/add-number', [StepController::class, 'index'])->name('addNumber');

Route::post('/add-number', [StepController::class, 'createLocationRequest'])->name('createLocationRequest');

Route::get('/search-number/{uuid}', [StepController::class, 'searchNumber'])->name('searchNumber.show');

Route::get('/add-email', [StepController::class, 'addEmail'])->name('addEmail');

Route::get('/payment-geolocalyz', [StepController::class, 'PreparePayment'])->name('preparePayment');

Route::get('/login-user', [StepController::class, 'loginUser'])->name('loginUser');

Route::get('/access-Dashboard', [StepController::class, 'accessDashboard'])->name('accessDashboard');

Route::get('/access-Localisation/{uuid}', [StepController::class, 'accessLocalisation'])->name('accessLocalisation.show');