<?php
    require_once 'header.php';
?>

    <?php
        if(isset($_SESSION['userId'])) {
            echo "<p>You are logged in!</p>";
        }
        else {
            echo "<p>You are logged out!</p>";
        }
    ?>


<?php
    require_once 'footer.php';
?>