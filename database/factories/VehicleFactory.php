<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Toyota Avanza', 'Honda Jazz', 'Toyota Innova', 'Ford Everest']),
            'plate_number' => $this->faker->unique()->numerify('B #### ABC'),
            'type' => $this->faker->randomElement(['car', 'van', 'truck', 'motorcycle']),
            'condition' => $this->faker->randomElement(['good', 'good', 'good', 'needs_maintenance']),
            'availability' => $this->faker->randomElement(['available', 'available', 'in_use']),
        ];
    }
}
