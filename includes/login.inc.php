<?php
    require_once "../composer/vendor/autoload.php";
    require_once "dbh.inc.php";        
    if(isset($_POST['login-submit'])) {

        $mailuid = $_POST['mailuid'];
        $pwd = $_POST['password'];

        if(empty($mailuid) || empty($pwd)) {
            header("Location: " . $parent . "?error=emptyfields");
            exit();
        }
        else {
            // Select info for password comparison and session storage
            $sql = "SELECT uid, username, pwd FROM players WHERE username=? OR email=?;";

            if(!$stmt = $conn->prepare($sql)) {
                header("Location: " . $parent . "?error=sqlerror");
                exit();
            }

            // Bind params for username and email
            $stmt->bindParam(1, $mailuid, PDO::PARAM_STR);
            $stmt->bindParam(2, $mailuid, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch data
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pwd_check = password_verify($pwd, $row['pwd']);
                if($pwd_check == false) {
                    header("Location: " . $parent . "?error=wrongpwd");
                    exit();
                }
                else if($pwd_check == true) {
                    session_start();
                    $_SESSION['userId'] = $row['uid'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ". $parent . "?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: " . $parent . "?error=nouser");
                exit();
            }
        }
    }
    else {
        header("Location: " . $parent);
        exit();
    }