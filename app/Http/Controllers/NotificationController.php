<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);
        
        $notification->markAsRead();

        return back()->with('success', 'Notifikasi ditandai sebagai dibaca!');
    }

    public function markAllAsRead()
    {
        auth()->user()->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi ditandai sebagai dibaca!');
    }
}
