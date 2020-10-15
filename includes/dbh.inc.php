<?php

    $full_path = dirname(__FILE__);
    $full_path = str_replace("/includes", "", $full_path);
    require_once $full_path . "/composer/vendor/autoload.php";
    
    // Expects a .env file in the project root
    $dotenv = Dotenv\Dotenv::createImmutable($full_path);
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
