<?php
    session_start();

    require_once("../database/db_conn.php");
    require_once("../home/queries/record_logs.php");

    recordLog($_SESSION["userID"], "Logout", $conn);

    header("location: ../home/index.php");
    session_start();
    session_destroy();
?>