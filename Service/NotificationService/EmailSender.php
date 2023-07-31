<?php

namespace Service\NotificationService;

class EmailSender implements NotificationSender
{

    public function sendNotification(string $recipient, string $message):void
    {
        echo "Thank you for your submission! By email " . '<br>';
        // TODO: Implement email sending logic here (using third-party libraries/APIs)
    }
}