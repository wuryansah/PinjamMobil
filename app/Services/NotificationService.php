<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public function create(int $userId, int $requestId, string $type, string $title, string $message): Notification
    {
        return Notification::create([
            'user_id' => $userId,
            'request_id' => $requestId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }

    public function notifyAdmins(int $requestId, string $type, string $title, string $message): void
    {
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $this->create($admin->id, $requestId, $type, $title, $message);
        }
    }

    public function notifyUser(User $user, int $requestId, string $type, string $title, string $message): Notification
    {
        return $this->create($user->id, $requestId, $type, $title, $message);
    }
}
