<?php
    require_once '../../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if( $_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = $_POST['query'];
        $sql = "SELECT uid, username, first_name, last_name FROM players WHERE username REGEXP ? OR first_name REGEXP ? OR last_name REGEXP ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(1, $query, PDO::PARAM_STR);
            $stmt->bindParam(2, $query, PDO::PARAM_STR);
            $stmt->bindParam(3, $query, PDO::PARAM_STR);
            $stmt->execute();

            $arr = [];
            $arr['message'] = 'Success';
            $arr['content'] = [];
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $arr['content'][] = $row;
            }

            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($arr);
            exit();
        }
    }
    else {
        $out = array();
        $out['message'] = 'Invalid request!';

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($arr);
        exit();
    }