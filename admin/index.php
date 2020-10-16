<?php
    session_start();

    if(!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header("Location: ../index.php");
        exit();
    }

    require_once "header.php";
?>

<?php
    require_once "footer.php";

?>
