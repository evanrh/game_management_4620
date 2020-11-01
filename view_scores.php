<?php
    require_once 'header.php';

    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT title, score FROM games INNER JOIN (SELECT players.username, score, gid FROM players JOIN scores USING (uid) WHERE players.uid=$_SESSION[userId]) as p_scores USING (gid)";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

?>
    <h1><?php echo $_SESSION['username']?>'s Scores</h1>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>\n";
                echo "\t<td>$row[title]</td>\n";
                echo "\t<td>$row[score]</td>\n";
                echo "</tr>\n";
            }
        ?>
        </tbody>
    </table>
<?php
    require_once 'footer.php';
?>