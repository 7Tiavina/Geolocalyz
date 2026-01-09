<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display the add number view.
     */
    public function index()
    {
        return view('addNumber');
    }

    public function searchNumber(Request $request)
    {
        $phone = $request->phone;
        return view('searchNumber', compact('phone'));
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
        // Logic for accessing the dashboard can be added here
        return view('dashboardUser');
    }

    public function accessLocalisation()
    {
        // Logic for accessing the localisation can be added here
        return view('localisationUser');
    }
}
