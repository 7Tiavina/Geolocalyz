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
        return "Debug: addNumber route reached";
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

    public function addEmail()
    {
        return view('addEmail');
    }

    public function PreparePayment(Request $request)
    {
        $email = $request->email;
        return view('paymentForm', compact('email'));
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
