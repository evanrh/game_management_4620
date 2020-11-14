<?php
    require_once "header.php";
    
?>
<div class="flex" style="display: flex;">
    <div id="games" style="padding: 20px;">
        <h1>Recorded Games</h1>
        <ul id="admingames">
<?php
    // Display games currently in database
    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    $sql = "SELECT title FROM games";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . $row['title'] . '</li>';
    }
?>
        </ul>
    </div>
    <div style="padding: 20px; border-left: 2px solid black;">
        <h1>Add Game</h1>
        <div id="alertMessages">
        </div>
        <form method="POST">
            <div class="form-group row">
                <input type="text" class="form-control" id="newtitle" name="newgame">
            </div>
            <div class="form-group row">
                <button type="button" id="addgame" class="btn btn-primary">Add Game</button>
            </div>
        </form>
    </div>
</div>
<?php
    require_once "footer.php";

?>
