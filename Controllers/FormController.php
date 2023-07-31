<?php

namespace Controllers;

use Models\FormModel;
use Service\FormService;


require_once 'Models/FormModel.php';
require_once 'Models/Model.php';
require_once 'Service/FormService.php';

class FormController
{
    public string $csrfToken;
    public FormService $formService;
    private FormModel $formModel;


    public function __construct()
    {
        $this->formService = new FormService();
        $this->formModel = new FormModel();
        $this->csrfToken = $_SESSION['csrf_token'];
    }


    public function index()
    {
        $submittedData = $this->formModel->getWhereField(FormModel::TOKEN_ATTRIBUTE, $this->csrfToken);
        include 'views/form_view.php';
    }

    public function store()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token validation failed.");
        }
        $data = $this->formService->sanitizeInput($_POST['data'] ?? '');

        $this->formService->create($data);
        $submittedData = $this->formModel->getWhereField(FormModel::TOKEN_ATTRIBUTE, $this->csrfToken);

        include 'views/form_view.php';
    }

    public function about()
    {
        echo 'This is the about page.';
    }


}
