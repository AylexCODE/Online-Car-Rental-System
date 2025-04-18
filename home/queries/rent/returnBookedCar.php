<?php
    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_POST)){
        $rentalID = $_POST["RentalID"];
        $carID = $_POST["CarID"];

        $dents = $_POST["dents"];
        $scratches = $_POST["scratches"];
        $chippedPaint = $_POST["chippedPaint"];
        $crackedWindshields = $_POST["crackedWindshields"];
        $penalty = $_POST["penalty"];

        $rentalRetriveCar = "UPDATE rentals SET Status = 3, Penalty = '$penalty' WHERE RentalID = $rentalID";
        try{
            mysqli_query($conn, $rentalRetriveCar);
        }catch(mysqli_sql_exception){
            echo "Error";
        }

        $setCarAvailability = "UPDATE cars SET Availability = 1 WHERE CarID = $carID";
        try{
            mysqli_query($conn, $setCarAvailability);
        }catch(mysqli_sql_exception){
            echo "Error";
        }

        $isDamaged = 0;
        if($dents == 1 || $scratches == 1 || $chippedPaint == 1 || $crackedWindshields == 1){
            $isDamaged = 1;
        }
        $setCarDamages = "UPDATE damages SET isDamaged = '$isDamaged', Dents = '$dents', Scratches = '$scratches', ChippedPaint = '$chippedPaint', CrackedWindshields = '$crackedWindshields' WHERE CarID = '$carID';";
        try{
            mysqli_query($conn, $setCarDamages);
        }catch(mysqli_sql_exception $e){
            echo "Error";
            echo $e;
        }
    }
?>