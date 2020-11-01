<?php
    session_save_path('../sessions/');
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../index.php");