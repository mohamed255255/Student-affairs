<?php
namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $message = $request->input('message');
        event(new NotificationEvent($message));
        return response()->json(['status' => 'Notification sent!']);
    }
}
