<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UserSeeder::class,
            VehicleSeeder::class,
            VehicleRequestSeeder::class,
            UsageRecordSeeder::class,
        ]);
    }
}