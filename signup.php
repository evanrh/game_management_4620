<?php
    require_once 'header.php';
?>
    <h1>Signup</h1>
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
