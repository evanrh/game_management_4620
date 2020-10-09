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
            $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: " . $parent . "?error=sqlerror");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $pwd_check = password_verify($pwd, $row['pwdUsers']);
                if($pwd_check == false) {
                    header("Location: " . $parent . "?error=wrongpwd");
                    exit();
                }
                else if($pwd_check == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];

                    header("Location: " . $parent . "?login=success");
                    exit();
                }
                else {
                    header("Location: ". $parent . "?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: " . $parent . "error=nouser");
                exit();
            }
        }
    }
    else {
        header("Location: " . $parent);
        exit();
    }