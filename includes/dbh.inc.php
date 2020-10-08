<?php
    $server_name = "mysql-server";
    $db_user = "root";
    $db_name = "login_system";
    $db_pass = "secret";

    $conn = new mysqli($server_name, $db_user, $db_pass, $db_name);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
