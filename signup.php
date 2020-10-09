<?php
    require_once 'header.php';
?>
    <h1>Signup</h1>
    <div class="messages" style="width: 200px;">
    <?php
        // Display error messages
        if(isset($_GET['error'])) {
            if($_GET['error'] == 'emptyfields') {
                echo '<p class="alert alert-danger">Fill in all fields</p>';
            }
            else if($_GET['error'] == 'invalidmailuser') {
                echo '<p class="alert alert-danger">Enter a valid username and email</p>';
            }
            else if($_GET['error'] == 'invalidmail') {
                echo '<p class="alert alert-danger">Enter a valid email</p>';
            }
            else if($_GET['error'] == 'invalidusername') {
                echo '<p class="alert alert-danger">Enter a valid username</p>"';
            }
            else if($_GET['error'] == 'passwordcheck') {
                echo '<p class="alert alert-danger">Passwords do not match!</p>';
            }
            else if($_GET['error'] == 'sqlerror') {
                echo '<p class="alert alert-danger">Please re-enter your information</p>"';
            }
            else if($_GET['error'] == 'usernametaken') {
                echo '<p class="alert alert-danger">That username is already taken</p>"';
            }
        }
        else if($_GET['signup'] == 'success') {
            echo '<p class="alert alert-success">Account created!</p>';
        }

        ?>
        </div>
    <form style="width: 200px;" action="includes/signup.inc.php" method="POST">
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password-repeat" id="password-repeat" placeholder="Repeat password">
        </div>
        <button type="submit" class="btn btn-primary" name="signup-submit" id="signup-submit">Sign me up!</button>
    </form>
<?php
    require_once 'footer.php';
?>
