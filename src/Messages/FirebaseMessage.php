<?php

namespace GGInnovative\Larafirebase\Messages;

use GGInnovative\Larafirebase\Services\Larafirebase;

class FirebaseMessage extends Larafirebase
{
    public function asNotification()
    {
        return parent::sendNotification();
    }
}
