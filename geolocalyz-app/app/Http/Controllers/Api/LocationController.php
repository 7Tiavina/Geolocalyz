<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        $validated = $request->validate([
            'uuid' => 'required|uuid',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $locationRequest = LocationRequest::where('uuid', $validated['uuid'])->firstOrFail();

        $locationRequest->latitude = $validated['latitude'];
        $locationRequest->longitude = $validated['longitude'];
        $locationRequest->ip_address = $request->ip();

        // IP Geolocation
        try {
            $ipApiResponse = Http::get("https://ipapi.co/{$locationRequest->ip_address}/json/");
            if ($ipApiResponse->successful()) {
                $ipData = $ipApiResponse->json();
                $locationRequest->ip_country = $ipData['country_name'] ?? null;
                $locationRequest->ip_city = $ipData['city'] ?? null;
                $locationRequest->ip_asn = $ipData['asn'] ?? null;
                $locationRequest->ip_operator = $ipData['org'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('IP API call failed: ' . $e->getMessage());
        }

        // Reverse Geocoding
        try {
            $nominatimResponse = Http::withHeaders([
                'User-Agent' => 'Geolocalyz/1.0',
            ])->get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $locationRequest->latitude,
                'lon' => $locationRequest->longitude,
                'format' => 'jsonv2',
            ]);

            if ($nominatimResponse->successful()) {
                $addressData = $nominatimResponse->json();
                $address = $addressData['address'] ?? [];
                $locationRequest->full_address = $addressData['display_name'] ?? null;
                $locationRequest->country = $address['country'] ?? null;
                $locationRequest->region = $address['state'] ?? null;
                $locationRequest->city = $address['city'] ?? $address['town'] ?? $address['village'] ?? null;
                $locationRequest->neighborhood = $address['suburb'] ?? null;
                $locationRequest->street = $address['road'] ?? null;
                $locationRequest->postal_code = $address['postcode'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Nominatim API call failed: ' . $e->getMessage());
        }

        $locationRequest->save();

        return response()->json(['message' => 'Location updated successfully.']);
    }
}
