<?php
require_once 'config.php';

try {
    var_dump(DB_HOST, DB_USERNAME, DB_PASSWORD);
    // Connect to the database
    $dbh = new PDO("mysql:host=" . DB_HOST, DB_USERNAME, DB_PASSWORD);

    // Create the database if it doesn't exist
    $dbh->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $dbh->exec("USE " . DB_NAME );

    // Create the 'user_form' table if it doesn't exist
    $dbh->exec("
        CREATE TABLE IF NOT EXISTS user_form (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            csrf_token VARCHAR(255),
            description TEXT
        )
    ");

    echo "Database and table created successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}