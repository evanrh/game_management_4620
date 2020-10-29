<?php
    require_once 'header.php';

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT title FROM games";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
?>
    <h1>Score Entry</h1>
    <form method="POST">
        
        <div class="form-group row">
            <select class="form-control col-md-2">
                <?php
                    $i = 0;
                    // Populate list with games in database
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=$i>$row[title]</option>";
                        $i += 1;
                    }
                ?>
            </select>
            <input type="text" class="form-control col-md-2" id="score-entry">
        </div>
        <div class="form-group row">
            <button type="button" class="btn btn-primary">Submit Score</button>
        </div>
    </form>
<?php
    require_once 'footer.php';
?>