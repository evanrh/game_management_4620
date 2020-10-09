<?php
    session_start();
    if(!isset($_SESSION['userId'])) {
        header("Location: index.php");
        exit();
    }

    require_once "header.php";
    require_once "includes/dbh.inc.php";
?>
    <h2>Profile</h2>
    <?php
        // Display dynamic information
        $sql = "SELECT * FROM players WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        echo '<p>Username: ' . $_SESSION['username'] . "</p>";
        echo '<p>E-mail: ' . $row['email'] . '</p>';
        echo '<p>First name: ' . $row['first_name'] . '</p>';
        echo '<p>Last name: ' . $row['last_name'] . '</p>';
        echo '<p>Address: ' . $row['address'] . '</p>';
    ?>
    <a href="profile_update.php">
        <button type="submit" class="btn btn-info">Update Profile</button>
    </a>
<?php
    require_once "footer.php";
?>