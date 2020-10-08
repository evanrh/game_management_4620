<?php
    require_once "dbh.inc.php";

    if(isset($_POST['login-submit'])) {

        $mailuid = $_POST['mailuid'];
        $pwd = $_POST['password'];

        if(empty($mailuid) || empty($pwd)) {
            header("Location: ../login.php?error=emptyfields");
            exit();
        }
        else {
            $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../login.php?error=sqlerror");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $pwd_check = password_verify($password, );
            }
            else {
                header("Location: ../login.php?error=nouser");
            }
        }
    }
    else {
        header("Location: ../login.php");
        exit();
    }