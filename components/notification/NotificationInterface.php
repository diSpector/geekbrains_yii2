<?php

namespace app\components\notification;


interface NotificationInterface
{
    public function sendTodayNotification($activities);

    public function composeEmail($activities, $email, $subject);
}