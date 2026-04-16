<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VehicleRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleRequestFactory extends Factory
{
    protected $model = VehicleRequest::class;

    public function definition(): array
    {
        return [
            'borrower_id' => User::factory(),
            'destination' => $this->faker->city(),
            'purpose' => $this->faker->randomElement(['Client Meeting', 'Site Visit', 'Delivery', 'Event']),
            'start_datetime' => now()->addDays($this->faker->numberBetween(1, 7)),
            'end_datetime' => now()->addDays($this->faker->numberBetween(8, 14)),
            'status' => $this->faker->randomElement(['pending', 'pending', 'manager_approved', 'admin_approved']),
        ];
    }
}
