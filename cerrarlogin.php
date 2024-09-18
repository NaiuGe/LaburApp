<?php
    session_name("LOGIN");
    session_start();

    session_destroy();
    header("location:index.php");
?>