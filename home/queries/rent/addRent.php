<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");
    session_start();
    
    if(isset($_POST)){
        $carID = $_POST["carID"];
        $userID = $_POST["userID"];
        $pickUpLocation = $_POST["pickUpLocation"];
        $dropOffLocation = $_POST["dropOffLocation"];
        $startDateTime = $_POST["startDateTime"];
        $endDateTime = $_POST["endDateTime"];
        $paymentMethod = $_POST["paymentMethod"];
        $amountPaid = $_POST["amountPaid"];
        $voucher = $_POST["voucher"];
        $paymentFrequency = $_POST["paymentFrequency"];

        $updateCarAvailable = "UPDATE cars SET Availability = 0 WHERE CarID = '$carID'";

        try{
            if(mysqli_query($conn, $updateCarAvailable)){
                $addRentalQuery = "INSERT INTO rentals VALUES (null, '$userID', '$carID', '$pickUpLocation', '$dropOffLocation', '$startDateTime', '$endDateTime', 0, 0);";

                try{
                    if(mysqli_query($conn, $addRentalQuery)){
                        $getRentalIDQuery = "SELECT RentalID FROM rentals WHERE UserID = '$userID' ORDER BY RentalID DESC;";
                       
                        try{
                            if($execQuery = mysqli_query($conn, $getRentalIDQuery)){
                                $getRentalID = mysqli_fetch_assoc($execQuery);
                                $rentalID = $getRentalID["RentalID"];
                                $voucher == "" ? $voucher = "NA" : "";
                                $addPaymentQuery = "INSERT INTO payments VALUES (null, '$rentalID', NOW(), '$paymentFrequency', '$amountPaid','$paymentMethod', 0, '$voucher');";
                                
                                recordLog($_SESSION["userID"], "Booked Car ID $carID", $conn);
                                try {
                                    mysqli_query($conn, $addPaymentQuery);
                                }catch(mysqli_sql_exception $e){
                                    echo "Error Add Payment" . $e;
                                }
                                
                                if($voucher != "" || $voucher != "NA"){
                                    $getVoucherInfo = "SELECT UsedTimes FROM vouchers WHERE VoucherUID = '$voucher';";
                                   
                                    try{
                                        $execGetVoucherInfo = mysqli_query($conn, $getVoucherInfo);
                                        $getUsedTimes = mysqli_fetch_assoc($execGetVoucherInfo);
                                        $usedTimes = $getUsedTimes["UsedTimes"];
                                    
                                        $updateVoucherQuery = "UPDATE vouchers SET UsedTimes = '" . $usedTimes+1 . "' WHERE VoucherUID = '$voucher';";
                                    
                                        try{
                                            mysqli_query($conn, $updateVoucherQuery);
                                        }catch(mysqli_sql_exception){
                                            echo "Error Updating Voucher";
                                        }
                                    }catch(mysqli_sql_exception){
                                        echo "Error Getting Voucher Info";
                                    }
                                }
                            }
                        }catch(mysqli_sql_exception){
                            echo "Error Getting Rental ID";
                        }
                    }
                }catch(mysqli_sql_exception $e){
                    echo "Error Add Rental" . $e;
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