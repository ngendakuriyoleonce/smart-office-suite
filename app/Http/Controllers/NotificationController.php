<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): View
    {

        Auth::user()->unreadNotifications->markAsRead();

        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return back()->with('success', 'Notification marked as read.');
    }
}
