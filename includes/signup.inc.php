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

            // TODO: Check if email is already in use
            // SQL Query to check if username is in DB
            $sql = "SELECT username FROM players WHERE username=?";
            $stmt = $conn->stmt_init();

            if(!$stmt->prepare($sql)) {
                header("Location ../signup.php?error=sqlerror");
                exit();
            }
            else {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                $result_check = $stmt->num_rows();

                if($result_check > 0) {
                    header("Location: ../signup.php?error=usernametaken&email=" . $email);
                    exit();
                }

                $sql = "INSERT INTO players (username, email, pwd) VALUES (?, ?, ?)";
                if(!$stmt->prepare($sql)) {
                    header("Location ../signup.php?error=sqlerror");
                    exit();
                }

                $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                $stmt->bind_param("sss", $username, $email, $pwd_hash);
                $stmt->execute();
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }

        $stmt->close($stmt);
        $conn->close();
    }

else {
    header("Location: ../signup.php");
    exit();
}