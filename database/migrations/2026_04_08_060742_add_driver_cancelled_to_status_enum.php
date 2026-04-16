<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");
        });

        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status ENUM('pending', 'manager_approved', 'manager_rejected', 'admin_approved', 'admin_rejected', 'in_progress', 'completed', 'driver_cancelled') DEFAULT 'pending'");
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");
        });

        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status ENUM('pending', 'manager_approved', 'manager_rejected', 'admin_approved', 'admin_rejected', 'in_progress', 'completed') DEFAULT 'pending'");
        });
    }
};
