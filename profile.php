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
    ?>
    <form>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="email" value=<?php echo $row['email']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="username" value=<?php echo $_SESSION['username']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="first_name" value=<?php echo $row['first_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="last_name" value=<?php echo $row['last_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="address" value=<?php echo $_SESSION['address']?>>
        </div>
    </div>
    <a href="profile_update.php">
        <button type="button" class="btn btn-info">Update Profile</button>
    </a>
<?php
    require_once "footer.php";
?>