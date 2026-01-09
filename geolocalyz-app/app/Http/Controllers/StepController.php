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
}
