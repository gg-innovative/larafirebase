<?php

namespace GGInnovative\Larafirebase\Channels;

use Illuminate\Notifications\Notification;

class FirebaseChannel
{
    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var \GGInnovative\Larafirebase\FirebaseMessage $message */
        $message = $notification->toFirebase($notifiable);
    }
}
