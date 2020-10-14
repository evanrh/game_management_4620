<?php

    $full_path = dirname(__FILE__);
    $full_path = str_replace("/includes", "", $full_path);
    require_once $full_path . "/composer/vendor/autoload.php";
    
    // Expects a .env file in the project root
    $dotenv = Dotenv\Dotenv::createImmutable($full_path);
    $dotenv->load();

    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
