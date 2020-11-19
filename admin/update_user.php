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
<form>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="email" value=<?php echo $info['email']?>>
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
            <input type="text" readonly class="form-control-plaintext" id="first_name" value=<?php echo $info['first_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="last_name" value=<?php echo $info['last_name']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="address" value=<?php echo $info['address']?>>
        </div>
    </div>
    <div class="form-group row">
        <label for="age" class="col-sm-2 col-form-label">Age</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="age" value=<?php echo $info['age']?>>
        </div>
    </div>
    <a href="profile_update.php">
        <button type="button" class="btn btn-info">Update Profile</button>
    </a>
<?php
    require_once 'footer.php';

?>