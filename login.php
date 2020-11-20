<?php
    require_once 'header.php';
?>
    <h1>Login</h1>
    <form style="width: 200px;" action="includes/login.inc.php" method="POST">
        <div class="form-group">
            <label class="form-label" for="mailuid">Username/Email</label>
            <input type="text" class="form-control" id="mailuid" name="mailuid" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        
        <button type="submit" class="btn btn-primary" name="login-submit" id="login-submit">Login</button>
    </form>

<?php
    require_once 'footer.php';
?>