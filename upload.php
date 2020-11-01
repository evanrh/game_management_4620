<?php
    require_once 'header.php';

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT title FROM games";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

?>
    <h1>Score Entry</h1>
    <?php
        if(isset($_GET['error'])) {
            $value = '';
            $error = $_GET['error'];
            switch($error) {
                case 'sqlerror':
                    $value = 'Error in database';
                    break;
                case 'nogame':
                    $value = 'Game not in database';
                    break;
                default:
                    $value = 'Error!';
                    break;
            }
            echo "<p class='alert alert-danger col-md-4'>$value</p>";
        }
        else if(isset($_GET['success'])) {
            echo "<p class='alert alert-success col-md-4'>Score added successfully!</p>";
        }
        ?>
    <form method="POST" action="includes/upload.inc.php">

        <div class="form-group">
            <label for="game-name">Game Name</label>
            <input type="text" class="form-control col-md-2" name="game-name" id="game-name" required>
            <label for="score-entry">Score</label>
            <input type="number" min="1" step="1" class="form-control col-md-2" name="score-entry" id="score-entry" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit-score" id="submit-score">Submit Score</button>
        </div>
    </form>
<?php
    require_once 'footer.php';
?>