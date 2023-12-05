<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeerTest extends TestCase
{
    /** @teste */
    public function testIndexRouteJsonReturnAuthenticated(): void
    {
        $this->withHeaders([
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' =>[
                    'current_page',
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'abv',
                            'color',
                            'brewery',
                            'beer_style_id',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            ]);
    }

    public function testShowRouteJsonReturnAuthenticated(): void
    {
        $this->withHeaders([
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer/1');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'abv',
                    'color',
                    'brewery',
                    'beer_style_id',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function testIndexRouteJsonReturnUnauthenticated(): void
    {
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer');
        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function testShowRouteJsonReturnUnauthenticated(): void
    {
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer/1');
        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
