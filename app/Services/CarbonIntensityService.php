<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CarbonIntensityService
{
    protected $apiUrl = 'https://api.electricitymap.org/v3/carbon-intensity/latest'; // Updated URL
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('ELECTRICITY_MAPS_API_KEY');
    }

    public function getCarbonIntensity($zone)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])->get($this->apiUrl, [
            'zone' => $zone
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // echo '<pre>';
        // print_r($data['carbonIntensity']); exit;

            return $data['carbonIntensity'] ?? null;
        }

        return null;
    }
}
