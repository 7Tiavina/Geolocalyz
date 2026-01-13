<?php

namespace App\Http\Controllers;

use App\Models\LocationRequest;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function showTrackerPage(string $uuid)
    {
        $locationRequest = LocationRequest::where('uuid', $uuid)->firstOrFail();
        return view('tracker', compact('locationRequest'));
    }
}
