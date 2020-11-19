<?php
    require_once 'header.php';

    require_once '../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT * FROM players";

?>
<h1>Players in System</h1>
<div id="player-search">
    <div class="row form-inline" style="padding-bottom: 10px;">
        <label class="form-label col-sm-2" for="search-bar">Search</label>
        <input class="form-control col-sm-4" id="search-bar" type="text">
    </div>
</div>
<div id="players-table">
        <div id="pl-header">
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                </tr>
            </thead>
            <tbody id="players">
            <?php
                if( $stmt = $conn->prepare($sql) ) {
                    $stmt->execute();

                    // Put all users into a table
                    while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) { ?>
                        <tr>
                            <td><a href="./update_user.php?<?php echo $row['username']?>"> <?php echo $row['username']; ?> </a></td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                        </tr>
                    <?php }
                }
            ?>
            </tbody>
        </table>
    </div>
<?php
    require_once 'footer.php';

?>