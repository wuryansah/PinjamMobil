<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function ($table) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) DEFAULT 'employee'");
        });
        
        DB::table('users')->where('role', 'supervisor')->update(['role' => 'manager']);
        
        Schema::table('users', function ($table) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'employee', 'manager', 'driver') DEFAULT 'employee'");
        });
    }

    public function down(): void
    {
        Schema::table('users', function ($table) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) DEFAULT 'employee'");
        });
        
        DB::table('users')->where('role', 'manager')->update(['role' => 'supervisor']);
        
        Schema::table('users', function ($table) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'employee', 'supervisor', 'driver') DEFAULT 'employee'");
        });
    }
};