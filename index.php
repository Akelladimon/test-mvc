<?php
// Turn on error reporting for debugging (comment these lines on production)

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session for CSRF protection
session_start();

// Load the required files
require_once 'config.php';
require_once 'router.php';
require_once 'Models/FormModel.php';

