<?php
    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_POST)){
        $rentalID = $_POST["RentalID"];
        $carID = $_POST["CarID"];
        
        $rentalRetriveCar = "UPDATE rentals SET Status = 3 WHERE RentalID = $rentalID";
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
    }
?>