<?
    require_once "dbh.inc.php";
    $parent = "../profile_update.php";

    if(isset($_POST['profile-update-submit'])) {
        // Get all filled in fields of the form
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
    }
    else {
        header("Location: " . $parent);
        exit();
    }