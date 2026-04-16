<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'name' => 'Toyota Camry',
                'plate_number' => 'B 1234 ABC',
                'type' => 'car',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => 5,
            ],
            [
                'name' => 'Honda CR-V',
                'plate_number' => 'B 5678 DEF',
                'type' => 'car',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => 6,
            ],
            [
                'name' => 'Toyota Hiace',
                'plate_number' => 'B 9012 GHI',
                'type' => 'van',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => null,
            ],
            [
                'name' => 'Mitsubishi L300',
                'plate_number' => 'B 3456 JKL',
                'type' => 'van',
                'condition' => 'needs_maintenance',
                'availability' => 'maintenance',
                'driver_id' => null,
            ],
            [
                'name' => 'Suzuki Carry',
                'plate_number' => 'B 7890 MNO',
                'type' => 'truck',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => null,
            ],
            [
                'name' => 'Toyota Fortuner',
                'plate_number' => 'B 1111 PQR',
                'type' => 'car',
                'condition' => 'good',
                'availability' => 'in_use',
                'driver_id' => 5,
            ],
            [
                'name' => 'Honda Beat',
                'plate_number' => 'B 2222 STU',
                'type' => 'motorcycle',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => null,
            ],
            [
                'name' => 'Yamaha Nmax',
                'plate_number' => 'B 3333 VWX',
                'type' => 'motorcycle',
                'condition' => 'good',
                'availability' => 'available',
                'driver_id' => null,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }

        $this->command->info('Vehicles seeded successfully!');
    }
}