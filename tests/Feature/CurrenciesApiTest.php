<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;


class CurrenciesApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_not_authenticated(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/v1/crypto/currencies/litecoin');

        $response->assertStatus(401);
    }

    public function test_not_authenticated_all(): void
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/v1/crypto/currencies');

        $response->assertStatus(401);
    }

    public function test_litecoin_currency()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api_token', ['rates:get']);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ])->get('/api/v1/crypto/currencies/litecoin');

        $response->assertJsonStructure([
            'litecoin' => [
                'eur',
            ]
        ]);

        $response->assertStatus(200);

    }

    public function test_all_currencies()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api_token', ['rates:get']);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ])->get('/api/v1/crypto/currencies');

        $response->assertJsonStructure([
            'bitcoin' => [
                'eur',
            ],
            'litecoin' => [
                'eur',
            ]
        ]);

        $response->assertStatus(200);
    }
}
