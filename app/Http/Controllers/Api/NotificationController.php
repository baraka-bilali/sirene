<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function count()
    {
        $count = Notification::count(); // ou Notification::count()
        return response()->json(['count' => $count]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'message' => 'required|string',
        ]);

        $notification = Notification::create([
            'type' => $request->type,
            'message' => $request->message,
            'alert_time' => now(),
        ]);

        // Émet l’événement Pusher
        event(new MyEvent($notification->message));

        return response()->json(['status' => 'Notification envoyée']);
    }

    public function index()
    {
        return response()->json(Notification::latest()->get());
    }

    public function destroy($id)
    {
        $alert = Notification::find($id); // ou Notification::find($id)

        if (!$alert) {
            return response()->json(['message' => 'Alerte non trouvée'], 404);
        }

        $alert->delete();

        return response()->json(['message' => 'Alerte supprimée'], 200);
    }
}
