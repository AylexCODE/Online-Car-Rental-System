<?php
    header("location: ./home/index.php", true);
    session_start();
    session_destroy();
?>