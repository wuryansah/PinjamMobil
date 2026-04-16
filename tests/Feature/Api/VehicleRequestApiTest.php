<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\VehicleRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleRequestApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_request(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/requests', [
                'destination' => 'Jakarta',
                'purpose' => 'Client Meeting',
                'start_datetime' => now()->addDay()->toDateTimeString(),
                'end_datetime' => now()->addDays(2)->toDateTimeString(),
            ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['destination' => 'Jakarta']);

        $this->assertDatabaseHas('vehicle_requests', [
            'destination' => 'Jakarta',
            'borrower_id' => $user->id,
        ]);
    }

    public function test_can_list_own_requests(): void
    {
        $user = User::factory()->create();
        VehicleRequest::factory()->create(['borrower_id' => $user->id]);
        VehicleRequest::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/requests');

        $response->assertStatus(200);
    }

    public function test_can_view_request(): void
    {
        $user = User::factory()->create();
        $request = VehicleRequest::factory()->create(['borrower_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/requests/{$request->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $request->id]);
    }

    public function test_cannot_view_other_user_request(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $request = VehicleRequest::factory()->create(['borrower_id' => $otherUser->id]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson("/api/v1/requests/{$request->id}");

        $response->assertStatus(200);
    }

    public function test_cannot_create_request_with_invalid_dates(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/requests', [
                'destination' => 'Jakarta',
                'purpose' => 'Meeting',
                'start_datetime' => now()->addDays(2)->toDateTimeString(),
                'end_datetime' => now()->addDay()->toDateTimeString(),
            ]);

        $response->assertStatus(422);
    }
}
