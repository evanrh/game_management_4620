<?php

    require_once '../../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "UPDATE players SET first_name=?, last_name=?, age=?, address=? WHERE uid=?";
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        if($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(1, $_GET['first_name']);
            $stmt->bindParam(2, $_GET['last_name']);
            $stmt->bindParam(3, $_GET['age']);
            $stmt->bindParam(4, $_GET['address']);
            $stmt->bindParam(5, $_GET['uid']);
            $stmt->execute();
            $rows = $stmt->rowCount();

            if($rows == 1) {
                header("Location: ../update_user.php?user=$_GET[uid]&success=1");
                exit();
            }
            else {
                header("Location: ../update_user.php?user=$_GET[uid]&success=0");
                exit();
            }
        }
    }
    else {
        header('Location: ../users.php?error=badrequest');
        exit();
    }