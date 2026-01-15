<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeAndInvoiceMail;
use App\Models\LocationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StepController extends Controller
{
    /**
     * Display the add number view.
     */
    public function index()
    {
        return view('addNumber');
    }

    public function redirectAddNumber()
    {
        return view('addNumber');
    }
    public function createLocationRequest(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required',
        ]);

        $locationRequest = new LocationRequest();
        $locationRequest->phone_number = $request->phoneNumber;
        $locationRequest->uuid = Str::uuid();
        $locationRequest->save();

        return redirect()->route('searchNumber.show', ['uuid' => $locationRequest->uuid]);
    }

    public function searchNumber(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        $phone = $locationRequest->phone_number;
        return view('searchNumber', compact('phone', 'uuid'));
    }

    public function addEmail(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        return view('addEmail', compact('locationRequest'));
    }

    public function storeEmail(Request $request, string $uuid)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        $locationRequest->email = $request->email;
        $locationRequest->save();

        return redirect()->route('preparePayment', ['uuid' => $uuid, 'email' => $request->email]);
    }

    public function PreparePayment(Request $request, string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        $email = $request->email; // Email should be passed as a query parameter
        return view('paymentForm', compact('locationRequest', 'email'));
    }

    public function processPayment(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        $email = $locationRequest->email;

        // Generate a random password
        $generatedPassword = Str::random(10);

        // Find or create the user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Client ' . $email, // Placeholder name
                'password' => Hash::make($generatedPassword),
            ]
        );

        // Generate localization link
        $localizationLink = route('accessLocalisation.show', ['uuid' => $uuid]);

        // Send welcome and invoice email
        Mail::to($user->email)->send(new WelcomeAndInvoiceMail($user, $generatedPassword, $localizationLink));

        // For MVP, simply redirect to the dashboard after "payment processing"
        // In a real app, this is where payment gateway interaction would happen
        return redirect()->route('accessDashboard');
    }

    public function loginUser()
    {
        // Logic for user login can be added here
        return view('login');
    }
    
    public function accessDashboard()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('loginUser')->with('error', 'Please login to access your dashboard.');
        }

        $userEmail = Auth::user()->email;
        $locationRequests = LocationRequest::where('email', $userEmail)->latest()->get();
        
        return view('dashboardUser', compact('locationRequests'));
    }

    public function accessLocalisation(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        return view('localisationUser', compact('locationRequest'));
    }
}
