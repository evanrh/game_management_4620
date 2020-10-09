<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    require_once "header.php";
?>
    <h2>Update Profile Information</h2>
    <p class="alert alert-info">Please check off all info you wish to update!</p>
    <form style="width:300px;" action="includes/profile_update.inc.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-1">
                <input type="checkbox" name="email-check" class="form-control-sm">
            </div>
            <div class="form-group col-md-6">
                <input type="email" name="email" class="form-control" placeholder="E-mail">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-1">
                <input type="checkbox" name="email-check" class="form-control-sm">
            </div>
            <div class="form-group col-md-6">
                <input type="email" name="email" class="form-control" placeholder="E-mail">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="profile-update-submit" id="profile-update-submit">Submit</button>

    </form>
<?php
    require_once 'footer.php';
?>