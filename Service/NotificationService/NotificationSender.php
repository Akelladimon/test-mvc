<?php

namespace Service\NotificationService;

interface NotificationSender
{
    /**
     * @param string $recipient
     * @param string $message
     * @return void
     */
    public function sendNotification(string $recipient, string $message):void;

}