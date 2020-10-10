<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <title>Game Users Management</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
        
        <link rel="stylesheet" href="index.css"/>
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Game Users</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Tucker and Evan</p>
                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <?php
                        // Do not show signup button if user is logged in
                        if(!isset($_SESSION['username'])) {
                            echo '<li>
                            <a href="signup.php">Signup</a>
                            </li>';
                        }
                        else {
                            // Insert profile link
                            echo '<li>
                            <a href="profile.php">Profile</a>
                            </li>';
                            // Insert Score Upload Link
                            echo '<li>
                            <a href="upload.php">Upload Score</a>
                            </li>';
                        }
                    ?>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="search.php">Search</a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>

                        <?php
                            if(isset($_SESSION['username'])){
                                echo '<a href="includes/logout.inc.php">
                                        <button type="submit" id="logoutButton" class="btn btn-info">Logout</button>
                                        </a>';
                            }
                            else {
                                echo '<a href="login.php">
                                <button type="submit" id="loginButton" class="btn btn-info">Login</button>
                            	</a>';
				echo '<a href="signup.php">
				<button type="submit" id="signupButton" class="btn btn-info">Signup</button>
				</a>';
                            }
                        ?>
                    </div>
                </nav>
