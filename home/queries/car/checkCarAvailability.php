<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_POST)){
        $carID = $_POST["carID"];

        $checkCarQuery = "SELECT Availability FROM cars WHERE CarID = '$carID';";
        if($result = mysqli_query($conn, $checkCarQuery)){
            $availability = mysqli_fetch_assoc($result);

            echo $availability["Availability"];
        }
    }
?>