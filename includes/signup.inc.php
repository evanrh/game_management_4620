<?php

    $parent = "../signup.php";
    if( isset($_POST['signup-submit'])) {
        require 'dbh.inc.php';
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $pwd_repeat = $_POST['password-repeat'];
        
        // One of the prompts was not filled in
        if( empty($username) || empty($email) || empty($pwd) || empty($pwd_repeat)) {
            header("Location: " . $parent . "?error=emptyfields&email=" . $email . "&username=" . $username);
            exit();
        }
        // Invalid email and username
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            header("Location: " . $parent . "?error=invalidmailuser");
            exit();
        }
        // Invalid email
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: " . $parent . "?error=invalidmail&username=" . $username);
            exit();
        }
        // Invalid username
        else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
            header("Location: " . $parent . "?error=invalidusername&email=" . $email);
            exit();
        }
        // Password does not match the repeat
        else if($pwd !== $pwd_repeat) {
            header("Location: " . $parent . "?error=passwordcheck&email=" . $email . "&username=" . $username);
            exit();
        }
        else {

            // TODO: Check if email is already in use
            // SQL Query to check if username is in DB
            $sql = "SELECT username FROM players WHERE username=?";

            if(!$stmt = $conn->prepare($sql)) {
                header("Location " . $parent . "?error=sqlerror");
                exit();
            }
            else {
                $stmt->bindParam(1, $username, PDO::PARAM_STR);
                $stmt->execute();

                if($stmt->rowCount() > 0) {
                    header("Location: " . $parent . "?error=usernametaken&email=" . $email);
                    exit();
                }

                $sql = "INSERT INTO players (username, email, pwd) VALUES (?, ?, ?)";
                if(!$stmt = $conn->prepare($sql)) {
                    header("Location " . $parent . "?error=sqlerror");
                    exit();
                }

                $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
                $stmt->bindParam(1, $username, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $pwd_hash, PDO::PARAM_STR);
                $stmt->execute();
                header("Location: " . $parent . "?signup=success");
                exit();
            }
        }

        $stmt->close();
        $conn->close();
    }

else {
    header("Location: " . $parent);
    exit();
}