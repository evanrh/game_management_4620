<?php

    require_once 'header.php';
    require_once '../composer/vendor/autoload.php';

    if(!$_SESSION['admin']) {
        header("Location: ../index.php");
        exit();
    }


?>
    <h1>Backup Database</h1>
    <button type="submit" class="btn">
<?php
    require_once 'footer.php';

?>