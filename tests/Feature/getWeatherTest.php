<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class getWeatherTest extends TestCase
{
    /**
     * A basic feature test for getWeather route.
     *
     * @return void
     */
    public function test_example()
    {

        $response = $this->get('/getWeather?cvr=' . '39230992');
        $response->assertStatus(200);


        $response->assertJsonStructure([
            'success',
            'data' => [
                'temperature',
                'skyText',
                'humidity',
                'windText',
            ],
        ]);

    }
}
