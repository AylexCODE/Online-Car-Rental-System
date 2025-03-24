<?php
    $conn;

    try{
        $conn = mysqli_connect("localhost", "root", "", "car_rental_system");
    }catch(mysqli_sql_exception){
        echo "Error: Can't connect to database!";
    }
?>