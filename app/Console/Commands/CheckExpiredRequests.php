<?php

namespace App\Console\Commands;

use App\Models\VehicleRequest;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class CheckExpiredRequests extends Command
{
    protected $signature = 'requests:check-expired';

    protected $description = 'Check and expire pending vehicle requests that have passed their end_datetime';

    public function __construct(
        protected NotificationService $notificationService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $expiredRequests = VehicleRequest::where('status', 'pending')
            ->where('end_datetime', '<', now())
            ->get();

        foreach ($expiredRequests as $request) {
            $request->update(['status' => 'expired']);

            $this->notificationService->notifyUser(
                $request->borrower,
                $request->id,
                'request_expired',
                'Request Expired',
                'Your vehicle request has expired.'
            );

            $this->info("Expired request #{$request->id}");
        }

        $this->info("Checked {$expiredRequests->count()} expired requests.");

        return Command::SUCCESS;
    }
}
