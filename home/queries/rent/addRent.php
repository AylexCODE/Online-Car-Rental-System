<?php
    require_once("../../../database/db_conn.php");
    if(isset($_POST)){
        $carID = $_POST["carID"];
        $UID = $_POST["UID"];
        $pickUpLocation = $_POST["pickUpLocation"];
        $dropOffLocation = $_POST["dropOffLocation"];
        $startDateTime = $_POST["startDateTime"];
        $endDateTime = $_POST["endDateTime"];
        $paymentMethod = $_POST["paymentMethod"];
        $amountPaid = $_POST["amountPaid"];
        $voucher = $_POST["voucher"];

        $updateCarAvailable = "UPDATE cars SET Availability = 0 WHERE CarID = '$carID'";

        try{
            if(mysqli_query($conn, $updateCarAvailable)){
                $addRentalQuery = "INSERT INTO rentals VALUES (null, '$UID', '$carID', '$pickUpLocation', '$dropOffLocation', '$startDateTime', '$endDateTime', 0);";

                try{
                    if(mysqli_query($conn, $addRentalQuery)){
                        $getRentalIDQuery = "SELECT RentalID FROM rentals WHERE UserID = '$UID' ORDER BY RentalID DESC;";
                       
                        try{
                            if($execQuery = mysqli_query($conn, $getRentalIDQuery)){
                                $getRentalID = mysqli_fetch_assoc($execQuery);
                                $rentalID = $getRentalID["RentalID"];
                                $addPaymentQuery = "INSERT INTO payments VALUES (null, '$rentalID', NOW(), '$amountPaid', '$paymentMethod', 'Pending', '$voucher');";

                                try {
                                    mysqli_query($conn, $addPaymentQuery);
                                }catch(mysqli_sql_exception $e){
                                    echo "Error Add Payment";
                                    echo $e;
                                }
                            }
                        }catch(mysqli_sql_exception){
                            echo "Error Getting Rental ID";
                        }
                    }
                }catch(mysqli_sql_exception){
                    echo "Error Add Rental";
                }
            }
        }catch(mysqli_sql_exception){
            echo "Error Update Car";
        }
    }
?>

<?php
/*
if(isset($_POST)){
        $action = $_POST["action"];
        
        if($action == "updateCar"){
            $carID = $_POST["carID"];

            $updateCarAvailable = "UPDATE cars SET Availability = 0 WHERE CarID = '$carID'";
            
            try{
                mysqli_query($conn, $updateCarAvailable);
                echo "OK";
            }catch(mysqli_sql_exception){
                echo "Error";
            }
        }elseif($action == "addRental"){
            $UID = $_POST["UID"];
            $carID = $_POST["carID"];

            $pickUpLocation = $_POST["pickUpLocation"];
            $dropOffLocation = $_POST["dropOffLocation"];
            $startDateTime = $_POST["startDateTime"];
            $endDateTime = $_POST["endDateTime"];

            $addRentalQuery = "INSERT INTO rentals VALUES (null, '$UID', '$carID', '$pickUpLocation', '$dropOffLocation', '$startDateTime', '$endDateTime');";

            try{
                mysqli_query($conn, $addRentalQuery);
                echo "OK";
            }catch(mysqli_sql_exception){
                echo "Error";
            }
        }elseif($action == "getRentalID"){
            $UID = $_POST["UID"];

            $getRentalIDQuery = "SELECT RentalID FROM rentals WHERE UserID = '$UID' ORDER BY RentalID DESC;";
        
            try{
                if($execQuery = mysqli_query($conn, $getRentalIDQuery)){
                    $getRentalID = mysqli_fetch_assoc($execQuery);
                    echo $getRentalID["RentalID"];
                }
            }catch(mysqli_sql_exception){
                echo "Error";
            }
        }elseif($action == "addPayment"){
            $rentalID = $_POST["rentalID"];
            $paymentMethod = $_POST["paymentMethod"];
            $amountPaid = $_POST["amountPaid"];
            $voucher = $_POST["voucher"];

            $addPaymentQuery = "INSERT INTO payments VALUES (null, '$rentalID', NOW(), '$amountPaid', '$paymentMethod', 'Pending', '$voucher');";
            
            try {
                 mysqli_query($conn, $addPaymentQuery);
            }catch(mysqli_sql_exception){
                    echo "Error";
            }
        }
    }
*/
?>