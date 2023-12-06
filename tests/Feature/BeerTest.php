<?php

namespace Tests\Feature;

use App\Models\Beer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeerTest extends TestCase
{
    /** @teste */
    public function testGetBeersRouteJsonReturnAuthenticated(): void
    {
        $headers = [
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json'
        ];

        $response = $this->get('/api/auth/beer', $headers);
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

    public function testGetBeerRouteJsonReturnAuthenticated(): void
    {
        $headers = [
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json'
        ];

        $response = $this->get('/api/auth/beer/1', $headers);
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

    public function testCreateBeerRouteJsonReturnAuthenticated(): void
    {
        $data = [
            'name' => 'Antarctica',
            'abv' => '4.4',
            'color' => 'Amarelo palha',
            'brewery' => 'Antarctica',
            'beer_style_id' => '1'
        ];

        $headers = [
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json'
        ];
        $response = $this->post('/api/auth/beer', $data, $headers);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'abv',
                    'color',
                    'brewery',
                    'beer_style_id',
                    'created_at',
                    'updated_at',
                    'id'
                ]
            ]);
    }

    public function testUpdateBeerRouteJsonReturnAuthenticated(): void
    {
        $data = [
            'name' => 'Antarctica',
            'abv' => '4.4',
            'color' => 'Amarelo palha',
            'brewery' => 'Antarctica',
            'beer_style_id' => 1
        ];

        $headers = [
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json',
        ];

        $response = $this->put('/api/auth/beer/1', $data, $headers);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Beer updated.'
            ]);
    }

    public function testDeleteBeerRouteJsonReturnAuthenticated(): void
    {
        $headers = [
            'Authorization' =>'Bearer oSRgJO1hQmDAAP31XPdntGGInsngykiQO2qZqcKf73580b99',
            'Accept' => 'application/json',
        ];

        $response = $this->delete('/api/auth/beer/19', [], $headers);
        $response->assertStatus(204);
    }

    public function testGetBeersRouteJsonReturnUnauthenticated(): void
    {
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer');
        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    public function testGetBeerRouteJsonReturnUnauthenticated(): void
    {
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
        $response = $this->get('/api/auth/beer/1');
        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }
}
