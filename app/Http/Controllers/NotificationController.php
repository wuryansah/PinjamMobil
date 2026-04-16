<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id === Auth::id()) {
            $notification->update(['is_read' => true]);
        }

        return back();
    }

    public function click(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            return redirect()->route('notifications.index');
        }

        $notification->update(['is_read' => true]);

        if ($notification->request_id) {
            return redirect()->route('requests.show', $notification->request_id);
        }

        return redirect()->route('dashboard');
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);

        return back();
    }
}
