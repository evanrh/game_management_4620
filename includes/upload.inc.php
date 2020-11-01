<?php

    session_save_path('../sessions/');
    session_start();
    require_once "../composer/vendor/autoload.php";

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    function redirect($param, $value) {
        $parent = "../upload.php";
        header("Location: $parent?$param=$value");
        exit();
    }
    // Check if requesting access through a post
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Server AJAX logic
        if(isset($_POST['title'])) {
            $sql = "SELECT title FROM games WHERE title REGEXP(?)";
            $title = $_POST['title'];
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->execute();

            $arr = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $arr[] = $row['title'];
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($arr);
            exit();
        }

        // Score submission logic
        else if(isset($_POST['submit-score'])) {
            // Grab game's id from games table
            $gameQuery = "SELECT gid FROM games WHERE title=?";
            if(!$stmt = $conn->prepare($gameQuery)) {
                redirect("error", "sqlerror");
            }
            $stmt->bindParam(1, $_POST['game-name'], PDO::PARAM_STR);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if game exists in database
            if($stmt->rowCount() == 0) {
                redirect("error", "nogame");
            }
            $gid = $row['gid'];

            // REPLACE ensures that a user only has one score for a given game, while also allowing them to add a score to any
            // game they currently don't have a score for
            $sql = "REPLACE INTO scores (gid, uid, score) VALUES (?, ?, ?)";

            if(!$stmt = $conn->prepare($sql)) {
                redirect("error", "sqlerror");
            }
            $stmt->bindParam(1, $gid, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->bindParam(3, $_POST['score-entry'], PDO::PARAM_INT);
            $stmt->execute();

            redirect("success", 1);
        }
    }