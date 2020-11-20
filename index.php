<?php
    require_once 'header.php';
?>
<h1>Home</h1>
    <?php
        if(isset($_SESSION['username'])) { ?>
            <p>You are logged in! Check out the links on the sidebar to see or submit scores.</p>
        <?php }
        else { ?>
            <p>Please signup or login to submit scores</p>
        <?php } ?>


<?php
    require_once 'footer.php';
?>