<?php

namespace App\Console\Commands;

use App\Models\FuelAttachment;
use App\Models\FuelRecord;
use App\Models\Notification;
use App\Models\UsageRecord;
use App\Models\VehicleRequest;
use Illuminate\Console\Command;

class ClearApplicationData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-data
                            {--force : Force the operation to run without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all fuel, request, and report data from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure you want to clear ALL fuel, request, and report data? This cannot be undone.', false)) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info('Clearing application data...');
        $this->newLine();

        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear fuel attachments
        $fuelAttachments = FuelAttachment::count();
        FuelAttachment::truncate();
        $this->info("✓ Cleared {$fuelAttachments} fuel attachments");

        // Clear fuel records
        $fuelRecords = FuelRecord::count();
        FuelRecord::truncate();
        $this->info("✓ Cleared {$fuelRecords} fuel records");

        // Clear usage records
        $usageRecords = UsageRecord::count();
        UsageRecord::truncate();
        $this->info("✓ Cleared {$usageRecords} usage records");

        // Clear notifications
        $notifications = Notification::count();
        Notification::truncate();
        $this->info("✓ Cleared {$notifications} notifications");

        // Clear vehicle requests
        $requests = VehicleRequest::count();
        VehicleRequest::truncate();
        $this->info("✓ Cleared {$requests} vehicle requests");

        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->newLine();
        $this->info('🎉 All data cleared successfully!');
        $this->info('Users and Vehicles have been preserved.');

        return 0;
    }
}
