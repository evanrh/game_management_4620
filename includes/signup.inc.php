<?php

    if( isset($_POST['signup-submit'])) {
        require 'dbh.inc.php';
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd_repeat = $_POST['password-repeat'];
        
        // One of the prompts was not filled in
        if( empty($username) || empty($email) || empty($pwd) || empty($pwd_repeat)) {
            header("Location: ../signup.php?error=emptyfields&email=" . $email . "&username=" . $username);
            exit();
        }
        // Invalid email and username
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            header("Location: ../signup.php?error=invalidmailuser");
            exit();
        }
        // Invalid email
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&username=" . $username);
            exit();
        }
        // Invalid username
        else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            header("Location: ../signup.php?error=invalidusername&email=" . $email);
            exit();
        }
        // Password does not match the repeat
        else if($pwd !== $pwd_repeat) {
            header("Location: ../signup.php?error=passwordcheck&email=" . $email . "&username=" . $username);
            exit();
        }
        else {

            // SQL Query to check if username is in DB
            $sql = "SELECT uidUsers FROM users  WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location ../signup.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $result_check = mysqli_stmt_num_rows($stmt);

                if($result_check > 0) {
                    header("Location: ../signup.php?error=usernametaken&email=" . $email);
                    exit();
                }

                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location ../signup.php?error=sqlerror");
                    exit();
                }

                $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $pwd_hash);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

else {
    header("Location: ../signup.php");
    exit();
}