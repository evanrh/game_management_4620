<?php
    session_start();

    require_once "../../composer/vendor/autoload.php";

    function send_json($message) {
        header('Content-Type: application/json; charset=utf-8');
        $arr = array();
        $arr['message'] = $message;
        echo json_encode($arr);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Load environment variables and add to DB
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
        $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $sql = "SELECT COUNT(*) as cnt FROM games WHERE title=?";

        $title = $_POST['title'];
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $title);
        $stmt->execute();

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $in_db = $rows['cnt'] > 0;
        if($in_db) {
            send_json('Game already in database');
            exit();
        }

        
        $sql = "INSERT INTO games(title) VALUES (?)";

        if(!$stmt = $conn->prepare($sql)) {
            send_json('SQL Error');
            exit();
        }
    
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows == 1) {
            send_json('Game added!');
            exit();
        }
        else {
            send_json('Game could not be added to database');
            exit();
        }
    }