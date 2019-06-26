<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class ApiWeatherTest
 * @package Tests\Feature
 */
class ApiWeatherTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiWeatherEndpoint()
    {
        $response = $this->json('POST','/api/auth', [
            'login' => 'user5',
            'password' => '123'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'token' => true
            ]);

        $token = $response->json('token');
        $response = null;
        $response = $this->withHeader('x-api-token', $token)->get('/api/weather');
        $response
            ->assertStatus(200)
            ->assertJson([
                'total' => true,
                'items' => true,
            ]);

    }
}
