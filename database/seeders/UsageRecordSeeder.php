<?php

namespace Database\Seeders;

use App\Models\UsageRecord;
use Illuminate\Database\Seeder;

class UsageRecordSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [
                'request_id' => 1,
                'start_km' => 15000.00,
                'end_km' => 15250.00,
                'fuel_used' => 18.50,
                'notes' => 'Perjalanan lancar, traffic normal',
            ],
            [
                'request_id' => 5,
                'start_km' => 18500.00,
                'end_km' => 18800.00,
                'fuel_used' => 22.00,
                'notes' => 'Cuaca hujan di beberapa路段',
            ],
            [
                'request_id' => 7,
                'start_km' => 5000.00,
                'end_km' => 5150.00,
                'fuel_used' => 8.00,
                'notes' => 'Pengiriman selesai tepat waktu',
            ],
        ];

        foreach ($records as $record) {
            UsageRecord::create($record);
        }

        $this->command->info('Usage records seeded successfully!');
    }
}