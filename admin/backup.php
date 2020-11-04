<?php

    require_once 'header.php';
    require_once '../composer/vendor/autoload.php';

    if(!$_SESSION['admin']) {
        header("Location: ../index.php");
        exit();
    }

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    
    $sql = "SHOW TABLES";

    $result = $conn->query($sql);
?>
    <h1>Backup Database</h1>
    <form id="backup-form" method="POST" action="./includes/backup.inc.php" target="_blank">
        <?php
            $i = 0;
            while($row = $result->fetch(PDO::FETCH_NUM)) {
                echo "<input type='checkbox' name='tables[$row[0]]'><label for='tables[$row[0]]'>$row[0]</label>";
                echo "<br/>";
                $i++;
            }
        ?>
        <button type="submit" id="backup-submit" class="btn btn-primary">Submit</button>
    </form
<?php
    require_once 'footer.php';

?>