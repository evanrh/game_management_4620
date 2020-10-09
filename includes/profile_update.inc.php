<?
    require_once "dbh.inc.php";
    $parent = "../profile_update.php";

    if(isset($_POST['profile-update-submit'])) {
        // Get all filled in fields of the form
    }
    else {
        header("Location: " . $parent);
        exit();
    }