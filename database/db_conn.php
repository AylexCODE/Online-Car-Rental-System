<?php
    $conn;

    try{
        $conn = mysqli_connect("192.168.1.9", "root", "root", "car_rental_system");
    }catch(mysqli_sql_exception){
        echo "Error: Can't connect to database!";
    }
?>