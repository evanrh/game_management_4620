<?php
    require_once '../composer/vendor/autoload.php';
    session_save_path('../sessions/');
    session_start();

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    }