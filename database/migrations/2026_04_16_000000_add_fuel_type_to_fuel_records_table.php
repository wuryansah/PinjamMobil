<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fuel_records', function (Blueprint $table) {
            $table->enum('fuel_type', ['Pertalite', 'Pertamax', 'Pertamax Turbo', 'BioSolar', 'PertaminaDex'])->nullable()->after('fuel_amount');
        });
    }

    public function down(): void
    {
        Schema::table('fuel_records', function (Blueprint $table) {
            $table->dropColumn('fuel_type');
        });
    }
};
