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
            $stmt = $conn->stmt_init();

            if(!$stmt->prepare($sql)) {
                header("Location: " . $parent . "?error=sqlerror");
                exit();
            }

            // Bind params for username and email
            $stmt->bind_param("ss", $mailuid, $mailuid);
            $stmt->execute();


            $stmt->bind_result($uid, $username, $passwd);

            // Fetch data
            while($stmt->fetch()) {}
            if($stmt->num_rows()) {
                $pwd_check = password_verify($pwd, $passwd);
                if($pwd_check == false) {
                    header("Location: " . $parent . "?error=wrongpwd");
                    exit();
                }
                else if($pwd_check == true) {
                    session_start();
                    $_SESSION['userId'] = $uid;
                    $_SESSION['username'] = $username;

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