<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController; 

Route::get('/', function () {
    return view('home');
});

// Original addNumber route - displays the form
Route::get('/add-number', [StepController::class, 'index'])->name('addNumber');

// Route to create a LocationRequest (POST from addNumber form)
Route::post('/add-number', [StepController::class, 'createLocationRequest'])->name('createLocationRequest');

// Search page - displays blurred info (GET with UUID)
Route::get('/search-number/{uuid}', [StepController::class, 'searchNumber'])->name('searchNumber.show');

// Add Email page - displays form (GET with UUID)
Route::get('/add-email/{uuid}', [StepController::class, 'addEmail'])->name('addEmail');

// Store Email - handles POST from addEmail form (POST with UUID)
Route::post('/add-email/{uuid}', [StepController::class, 'storeEmail'])->name('storeEmail');

// Prepare Payment page - displays form (GET with UUID and Email)
Route::get('/payment-geolocalyz/{uuid}', [StepController::class, 'PreparePayment'])->name('preparePayment');

// Process Payment - handles POST from paymentForm (POST with UUID)
Route::post('/payment-geolocalyz/{uuid}', [StepController::class, 'processPayment'])->name('processPayment');

// Login User page
Route::get('/login-user', [StepController::class, 'loginUser'])->name('loginUser');

// Access Dashboard page
Route::get('/access-Dashboard', [StepController::class, 'accessDashboard'])->name('accessDashboard');

// Access Localisation page (map details)
Route::get('/access-Localisation/{uuid}', [StepController::class, 'accessLocalisation'])->name('accessLocalisation.show');

// Route for the person to be located
use App\Http\Controllers\TrackingController; // Add this line
Route::get('/track/{uuid}', [TrackingController::class, 'showTrackerPage'])->name('track.show');

