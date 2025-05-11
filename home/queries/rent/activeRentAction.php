<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $action = $_POST["action"];
        $rentalID = $_POST["rentID"];
        $carID = $_POST["carID"];

        $rentalActionQuery = "UPDATE rentals SET Status = '$action' WHERE RentalID = '$rentalID';";
        try{
            mysqli_query($conn, $rentalActionQuery);
            
            try{
                $processPayment = "UPDATE payments SET PaymentStatus = 1 WHERE RentalID = '$rentalID';";
                mysqli_query($conn, $processPayment);
            }catch(mysqli_sql_exception){
                echo "Error";
            }
            
            if($action == 5){
                $makeCarAvailableQuery = "UPDATE cars SET Availability = 1 WHERE CarID = '$carID';";
                try{
                    mysqli_query($conn, $makeCarAvailableQuery);
                    
                    try{
                        $processPayment = "UPDATE payments SET PaymentStatus = 2 WHERE RentalID = '$rentalID';";
                        mysqli_query($conn, $processPayment);
                    }catch(mysqli_sql_exception){
                        echo "Error";
                    }
                }catch(mysqli_sql_exception){
                    echo "Error";
                }
            }
        }catch(mysqli_sql_exception){
            echo "Error";
        }
    }
?>