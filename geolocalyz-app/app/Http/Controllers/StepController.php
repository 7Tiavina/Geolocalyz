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


    public function accessDashboard()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('loginUser');
        }

        // Get the authenticated user's email
        $userEmail = Auth::user()->email;

        // Retrieve all location requests associated with this email
        $locationRequests = LocationRequest::where('email', $userEmail)->latest()->get();

        // Pass the requests to the dashboard view
        return view('dashboardUser', compact('locationRequests'));
    }

    public function processPayment(Request $request, string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        $email = $locationRequest->email;

        $user = User::where('email', $email)->first();

        $generatedPassword = null;
        $localizationLink = route('track.show', ['uuid' => $uuid]);

        if (!$user) {
            // User does not exist, create a new one
            $generatedPassword = Str::random(10);
            $user = User::create([
                'name' => 'Client ' . $email, // Placeholder name
                'email' => $email,
                'password' => Hash::make($generatedPassword),
            ]);

            // Flash the generated password to the session for the modal
            $request->session()->flash('generatedPassword', $generatedPassword);
            
        }

        // Authenticate the user (either existing or newly created)
        Auth::login($user);

        // Send welcome and invoice email (always, but password only if generated)
        Mail::to($user->email)->send(new WelcomeAndInvoiceMail($user, $generatedPassword, $localizationLink));

        // For MVP, simply redirect to the dashboard after "payment processing"
        return redirect()->route('accessDashboard');
    }

            public function accessLocalisation(string $uuid)

            {

                $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();

                return view('localisationUser', compact('locationRequest'));

            }

        

            public function loginUser()

            {

                // Logic for user login can be added here

                return view('login');

            }

        

            public function authenticateUser(Request $request)

            {

                $credentials = $request->validate([

                    'email' => ['required', 'email'],

                    'password' => ['required'],

                ]);

        

                if (Auth::attempt($credentials)) {

                    $request->session()->regenerate();

        

                    return redirect()->intended(route('accessDashboard'));

                }

        

                return back()->withErrors([

                    'email' => 'The provided credentials do not match our records.',

                ])->onlyInput('email');

            }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
