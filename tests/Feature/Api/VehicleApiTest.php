<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_cannot_access_api(): void
    {
        $response = $this->getJson('/api/v1/vehicles');

        $response->assertStatus(401);
    }

    public function test_can_list_vehicles(): void
    {
        $user = User::factory()->create();
        $vehicle = Vehicle::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/vehicles');

        $response->assertStatus(200)
            ->assertJsonCount(1, '0');
    }

    public function test_can_filter_available_vehicles(): void
    {
        $user = User::factory()->create();
        Vehicle::factory()->create(['availability' => 'available']);
        Vehicle::factory()->create(['availability' => 'in_use']);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/vehicles?available=true');

        $response->assertStatus(200)
            ->assertJsonCount(1, '0');
    }

    public function test_can_create_vehicle(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/vehicles', [
                'name' => 'Toyota Avanza',
                'plate_number' => 'B 1234 ABC',
                'type' => 'car',
                'condition' => 'good',
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Toyota Avanza']);

        $this->assertDatabaseHas('vehicles', [
            'name' => 'Toyota Avanza',
            'plate_number' => 'B 1234 ABC',
        ]);
    }

    public function test_cannot_create_duplicate_plate(): void
    {
        $user = User::factory()->create();
        Vehicle::factory()->create(['plate_number' => 'B 1234 ABC']);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/vehicles', [
                'name' => 'Toyota Avanza',
                'plate_number' => 'B 1234 ABC',
                'type' => 'car',
                'condition' => 'good',
            ]);

        $response->assertStatus(422);
    }
}
