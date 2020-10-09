<?php
    session_start();
    if(!isset($_SESSION['userId'])) {
        header("Location: index.php");
        exit();
    }

    require_once "header.php";
    require_once "includes/dbh.inc.php";
?>
    <h2>Profile</h2>
    <?php
        // Display dynamic information
        $sql = "SELECT * FROM players WHERE uidUsers=?";
        echo '<p>Username: ' . $_SESSION['username'] . "</p>";
    ?>

<?php
    require_once "footer.php";
?>