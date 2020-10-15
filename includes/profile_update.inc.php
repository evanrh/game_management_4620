<?php
    require_once "dbh.inc.php";
    $parent = "../profile_update.php";
    session_start();
    
    function exitWithError($error) {
        header("Location: " . $parent . "?error=" . $error);
        exit();
    }

    if(isset($_POST['profile-update-submit'])) {
        // Get all filled in fields of the form
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql = "UPDATE players SET %s=? WHERE uid=?";
        $success = false;
        // Update Email
        if(!empty($email)) {

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                exitWithError("invalidmail");
            }

            if(!$stmt = $conn->prepare(sprintf($sql, "email"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }
        if(!empty($fname)) {

            if(!$stmt = $conn->prepare(sprintf($sql, "first_name"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $fname, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }
        if(!empty($lname)) {

            if(!$stmt = $conn->prepare(sprintf($sql, "last_name"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $lname, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }
        if(!empty($age)) {

            if(!$stmt = $conn->prepare(sprintf($sql, "age"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $age, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }
        if(!empty($phone)) {

            if(!$stmt = $conn->prepare(sprintf($sql, "phone"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $phone, PDO::PARAM_STR, 10);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }
        if(!empty($address)) {

            if(!$stmt = $conn->prepare(sprintf($sql, "address"))) {
                exitWithError("sqlerror");
            }

            $stmt->bindParam(1, $address, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['userId'], PDO::PARAM_INT);
            $stmt->execute();
            $success=true;
        }

        $conn = null;
        header("Location: " . $parent . "?success=" . $success);
        exit();

    }
    else {
        header("Location: " . $parent);
        exit();
    }