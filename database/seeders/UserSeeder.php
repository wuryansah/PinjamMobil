<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'department' => 'IT',
            'phone' => '081234567890',
        ]);

        $supervisorOps = User::create([
            'name' => 'John Supervisor',
            'email' => 'supervisor@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'department' => 'OPS',
            'phone' => '081234567891',
        ]);

        $supervisorHR = User::create([
            'name' => 'Sarah HR',
            'email' => 'supervisor2@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'department' => 'HR',
            'phone' => '081234567897',
        ]);

        User::create([
            'name' => 'Alice Employee',
            'email' => 'employee@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department' => 'MKT',
            'manager_id' => $supervisorOps->id,
            'phone' => '081234567892',
        ]);

        User::create([
            'name' => 'Bob Employee',
            'email' => 'bob@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department' => 'OPS',
            'manager_id' => $supervisorOps->id,
            'phone' => '081234567893',
        ]);

        User::create([
            'name' => 'Eve Employee',
            'email' => 'eve@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'department' => 'HR',
            'manager_id' => $supervisorHR->id,
            'phone' => '081234567898',
        ]);

        User::create([
            'name' => 'Charlie Driver',
            'email' => 'driver1@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'driver',
            'department' => 'OPS',
            'phone' => '081234567894',
        ]);

        User::create([
            'name' => 'David Driver',
            'email' => 'driver2@pinjammobil.com',
            'password' => Hash::make('password'),
            'role' => 'driver',
            'department' => 'OPS',
            'phone' => '081234567895',
        ]);

        Department::where('code', 'OPS')->update(['manager_id' => $supervisorOps->id]);
        Department::where('code', 'HR')->update(['manager_id' => $supervisorHR->id]);

        $this->command->info('Users seeded successfully!');
    }
}