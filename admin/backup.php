<?php

    require_once 'header.php';
    require_once '../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    
    $sql = "SHOW TABLES";

    $result = $conn->query($sql);
?>
    <h1>Backup Database</h1>
    <h2>Tables</h2>
    <p>Please select the tables you would like to backup</p>
    <form id="backup-form" method="POST" action="./includes/backup.inc.php" target="_blank">
        <div class="form-check">
        <?php
            $classes = "form-check-input col-md-8";
            $lb_class = "form-check-label";
            while($row = $result->fetch(PDO::FETCH_NUM)) {
                echo "<input type='checkbox' class='$classes' name='tables[$row[0]]'><label class='$lb_class' for='tables[$row[0]]'>$row[0]</label>";
                echo "<br/>";
            }
        ?>
        </div>
        <button type="submit" id="backup-submit" class="btn btn-primary">Submit</button>
    </form>
<?php
    require_once 'footer.php';

?>