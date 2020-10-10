<?php

    require_once "../composer/vendor/autoload.php";

    // Expects a .env file in the project root
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    $server_name = $_ENV['DB_HOST'];
    $db_user = $_ENV['DB_USER'];
    $db_name = $_ENV['DB_NAME'];
    $db_pass = $_ENV['DB_PASS'];

    $conn = new mysqli($server_name, $db_user, $db_pass, $db_name);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
