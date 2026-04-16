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
        
        DB::table('vehicle_requests')->where('status', 'supervisor_approved')->update(['status' => 'manager_approved']);
        DB::table('vehicle_requests')->where('status', 'supervisor_rejected')->update(['status' => 'manager_rejected']);
        
        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status ENUM('pending', 'manager_approved', 'manager_rejected', 'admin_approved', 'admin_rejected', 'in_progress', 'completed') DEFAULT 'pending'");
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");
        });
        
        DB::table('vehicle_requests')->where('status', 'manager_approved')->update(['status' => 'supervisor_approved']);
        DB::table('vehicle_requests')->where('status', 'manager_rejected')->update(['status' => 'supervisor_rejected']);
        
        Schema::table('vehicle_requests', function ($table) {
            DB::statement("ALTER TABLE vehicle_requests MODIFY COLUMN status ENUM('pending', 'supervisor_approved', 'supervisor_rejected', 'admin_approved', 'admin_rejected', 'in_progress', 'completed') DEFAULT 'pending'");
        });
    }
};