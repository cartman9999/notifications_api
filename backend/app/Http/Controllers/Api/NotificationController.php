<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Notification, User};
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Notifications index,
     * displayed notifications filtered by organization
     * 
     * @param Request $request
     * @return Response $response
     */
    public function index(Request $request) {
        // Get user data
        $user = User::whereAccessToken($request->header('x-access-token'))
                    ->first(['id', 'organization_id']);

        // Obtain organization notifications
        $notifications = Notification::join('users', 'users.id', '=', 'notifications.user_id')
                                    ->where('notifications.organization_id', '=', $user->organization_id)
                                    ->orderBy('notifications.created_at', 'desc')
                                    ->take(30)
                                    ->get([
                                        'notifications.id AS notification_id', 
                                        'notifications.event AS event',
                                        'notifications.read_at AS read_at',
                                        'users.name AS name',
                                        'users.last_name AS last_name',
                                        'notifications.created_at AS created_at'
                                    ]);

        return response($notifications, 200);
    }

    /**
     * Update notification status
     * 
     * @param Request $request
     * @return Response $response
     */
    public function updateStatus(Request $request) {
        // Find Notification
        $notification = Notification::find($request->notification_id);

        if (!$notification) {
            return response()->json(['message' => "Not found", 404]);
        }

        // Update notification status
        $notification->update([
            'read_at' => ($notification->read_at) ? null : now() 
        ]);

        return response()->json(['message' => "Notification updated succesfully"], 201);
    }
}
