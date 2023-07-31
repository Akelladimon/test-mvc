<?php

namespace Service\NotificationService;

class SMSSender implements NotificationSender
{

    /**
     * @param string $recipient
     * @param string $message
     * @return void
     */
    public function sendNotification(string $recipient, string $message):void
    {
        echo "Thank you for your submission! By SMS " . '<br>';
        // TODO: // Implement SMS sending logic here (using third-party libraries/APIs)
    }
}