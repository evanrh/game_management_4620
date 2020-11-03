<?php
    require_once 'header.php';

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT title FROM games";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

?>

    <div class="flex" style="display: flex; padding: 10px;">
            <form>

                <div class="form-group">
                    <label for="game-name">Game Name</label>
                    <input type="text" class="form-control col-md-12" name="game-name" id="game-name" required>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" name="show-leaderboard" id="show-leaderboard">Show Leaderboard</button>
                </div>
            </form>
            <div id="scoreUploadRight" style="margin-left: 10px; border-left: 1px solid black;">
                <div id="gamesButtons">
                <?php
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='row'>";
                        echo "<button type='button' class='btn btn-outline-secondary'>$row[title]</button>";
                        echo "</div>";
                    }
                ?>
                </div>
            </div>
    </div>

    <div id="leaderboard">
        <div id="lb-header">
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Position</th>
                    <th scope="col">Player</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody id="lb-scores">
            </tbody>
        </table>
    </div>
<?php
    require_once 'footer.php';

?>