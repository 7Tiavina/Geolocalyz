<?php

namespace App\Http\Controllers;

use App\Models\LocationRequest;
use Illuminate\Http\Request;
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
        $locationRequests = LocationRequest::latest()->get();
        return view('dashboardUser', compact('locationRequests'));
    }

    public function accessLocalisation(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        return view('localisationUser', compact('locationRequest'));
    }
}
