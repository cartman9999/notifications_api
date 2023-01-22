<?php

namespace App\Repositories;

use App\Models\{Notification};

class NotificationRepository
{
    /**
     * Create a new notification
     * 
     * @param int $user_id
     * @param int $organization_id
     * @param string $event
     * @return Notification $notification
     */
    public function createNotification(int $user_id, int $organization_id, string $event) {
        $notification = new Notification;
        $notification->user_id = $user_id;
        $notification->organization_id = $organization_id;
        $notification->event = $event;
        $notification->save();

        return $notification;
    }
}