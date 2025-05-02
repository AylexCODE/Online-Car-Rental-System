<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");
    session_start();

    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_POST)){
        $rentalID = $_POST["RentalID"];
        
        $rentalRetriveCar = "UPDATE rentals SET Status = 2 WHERE RentalID = $rentalID";
        try{
            mysqli_query($conn, $rentalRetriveCar);
            recordLog($_SESSION["userID"], "Retrieved Car Rental ID $rentalID", $conn);
        }catch(mysqli_sql_exception){
            echo "Error";
        }
    }
?>