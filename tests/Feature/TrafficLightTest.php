<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrafficLightTest extends TestCase
{
    
    public function it_returns_red_when_intensity_is_above_400()
    {
        $response = $this->get('/traffic-light/DE'); 
        $response->assertJson([
            'color' => 'red'
        ]);
    }

    public function it_returns_green_when_intensity_is_below_200()
    {
        $response = $this->get('/traffic-light/SE');
        $response->assertJson([
            'color' => 'green'
        ]);
    }

    public function it_returns_yellow_when_intensity_is_between_200_and_400()
    {
        $response = $this->get('/traffic-light/FR');
        $response->assertJson([
            'color' => 'yellow'
        ]);
    }
}
