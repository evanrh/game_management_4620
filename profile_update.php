<?php
    require_once "header.php";

    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

?>
    <h2>Update Profile Information</h2>
    <form  action="includes/profile_update.inc.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="E-mail">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="fname">First Name</label>
                <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="age">Age</label>
                <input type="text" id="age" name="age" class="form-control" placeholder="Age">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-label" for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Address">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="profile-update-submit" id="profile-update-submit">Submit</button>

    </form>
<?php
    require_once 'footer.php';
?>