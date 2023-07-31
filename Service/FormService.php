<?php

namespace Service;

use Models\FormModel;
use Service\NotificationService\EmailSender;
use Service\NotificationService\SMSSender;

require_once 'NotificationService/NotificationSender.php';
require_once 'NotificationService/SMSSender.php';
require_once 'NotificationService/EmailSender.php';

class FormService
{
    public FormModel $formModel;
    private string $csrfToken;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $this->csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $this->csrfToken;
        } else {
            $this->csrfToken = $_SESSION['csrf_token'];
        }

        $this->formModel = new FormModel();
    }


    /**
     * @param string $data
     * @return void
     */
    public function create(string $data): void
    {
        $email = '';
        $phone = '';

        $result = $this->formModel->store([
            FormModel::DESCRIPTION_ATTRIBUTE => $data,
            FormModel::TOKEN_ATTRIBUTE => $this->csrfToken
        ]);

        if (!$result) {
            return;
        }

        if (!is_null($email)) {
            $emailSender = new EmailSender();
            $emailSender->sendNotification($email, $data);
        }

        if (!is_null($phone)) {
            $smsSender = new SMSSender();
            $smsSender->sendNotification($phone, $data);
        }
    }


    /**
     * @return string
     * @throws \Exception
     */
    private function generateCsrfToken(): string
    {

        return $this->csrfToken;
    }

    /**
     * @param string $input
     * @return string
     */
    public function sanitizeInput(string $input): string
    {
        $input = trim($input);
        $input = stripslashes($input);

        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
}