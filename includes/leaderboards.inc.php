<?php
    require_once '../composer/vendor/autoload.php';
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if( $_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];

        // Get game ID
        $sql = "SELECT gid FROM games WHERE title=?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_ASSOC)['gid'];
        $sql = "SELECT username, score FROM players NATURAL JOIN (SELECT uid, score FROM games NATURAL JOIN scores WHERE games.gid=?) AS lb_scores ORDER BY score DESC LIMIT 100";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
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

    else {
        $out = array();
        $out['message'] = 'Invalid request!';

        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($arr);
        exit();
    }