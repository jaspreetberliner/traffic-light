<?php

namespace App\Http\Controllers;

use App\Services\CarbonIntensityService;

class TrafficLightController extends Controller
{
    protected $carbonIntensityService;

    public function __construct(CarbonIntensityService $carbonIntensityService)
    {
        $this->carbonIntensityService = $carbonIntensityService;
    }

    public function index($zone)
    {
        $carbonIntensity = $this->carbonIntensityService->getCarbonIntensity($zone);

        // echo '<pre>';
        // print_r($this->carbonIntensityService); exit;

        if ($carbonIntensity === null) {
            return response()->json(['error' => 'Could not fetch carbon intensity'], 500);
        }

        $trafficLightColor = $this->getTrafficLightColor($carbonIntensity);

        return response()->json(['traffic_light' => $trafficLightColor, 'carbon_intensity' => $carbonIntensity]);
    }

    private function getTrafficLightColor($carbonIntensity)
    {
        if ($carbonIntensity > 400) {
            return 'red';
        } elseif ($carbonIntensity < 200) {
            return 'green';
        } else {
            return 'yellow';
        }
    }
}
