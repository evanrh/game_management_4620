<?php
    require_once "dbh.inc.php";    
    $parent = "../login.php";
    
    if(isset($_POST['login-submit'])) {

        $mailuid = $_POST['mailuid'];
        $pwd = $_POST['password'];

        if(empty($mailuid) || empty($pwd)) {
            header("Location: " . $parent . "?error=emptyfields");
            exit();
        }
        else {
            $sql = "SELECT * FROM players WHERE username=? OR email=?;";
            $stmt = $conn->stmt_init();

            if(!$stmt->prepare($sql)) {
                header("Location: " . $parent . "?error=sqlerror");
                exit();
            }

            $stmt->bind_param("ss", $mailuid, $mailuid);
            $stmt->execute();
            $result = $stmt->get_result();

            if($row = $result->fetch_assoc()) {
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