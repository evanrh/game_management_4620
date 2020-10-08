<?php

    if( isset($_POST['signup-submit'])) {
        require 'dbh.inc.php';
        
        $email = $_POST['email'];
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        
        if( empty($username) || empty($email) || empty($pwd)) {
            header("Location: ../signup.php?error=emptyfields&email=" . $email . "&username=" . $username);
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&username=" . $username);
            exit();
        }
    }
