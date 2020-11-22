<?php

    if( !isset($_GET['user'])) {
        header('Location: ./users.php');
        exit();
    }
    require_once 'header.php';

    require_once '../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dsn = "mysql:dbname=" . $_ENV['DB_NAME'] . ";host=" . $_ENV['DB_HOST'];
    $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $sql = "SELECT * FROM players WHERE uid=?";
    if($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(1, $_GET['user']);
        $stmt->execute();
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>
<h1><?php echo $info['username'] ?>'s Account</h1>
<p>Adjust any value and submit to update them</p>
<form method="GET" action="./includes/update_user.inc.php">
    <input type="number" style="display: none" name="uid" value="<?php echo $_GET['user'] ?>">
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-6">
            <input type="text" readonly name="email" class="form-control" id="email" value=<?php echo $info['email']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-6">
            <input type="text" readonly name="username" class="form-control" id="username" value=<?php echo $info['username']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="first_name"class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" name="first_name" class="form-control" id="first_name" value=<?php echo $info['first_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" name="last_name" class="form-control" id="last_name" value=<?php echo $info['last_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" name="address" class="form-control" id="address" value=<?php echo $info['address']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="age" class="col-sm-2 col-form-label">Age</label>
        <div class="col-sm-6">
            <input type="text" name="age" class="form-control" id="age" value=<?php echo $info['age']?>>
        </div>
    </div>
    <button type="submit" class="btn btn-info">Update Profile</button>
<?php
    require_once 'footer.php';

?>