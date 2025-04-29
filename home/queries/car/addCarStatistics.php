<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $carID = $_POST["CarID"];
        $type = $_POST["Type"];
        $damages = $_POST["Damages"];
        
        $addStatsQuery = "INSERT INTO car_statistics VALUES (null, '$carID', '" . $_SESSION["userID"] . "', NOW(), '$type', '$damages');";
        try{
            mysqli_query($conn, $addStatsQuery);
            echo "Ok";
        }catch(mysqli_sql_exception $e){
            echo "Error $e";
        }
    }
?>