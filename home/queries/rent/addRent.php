<?php
    require_once("../../../database/db_conn.php");

    $carID;
    $pickUpLocation;
    $dropOffLocation;
    $startDateTime;
    $endDateTime;
    $paymentMethod;
    $amountPaid;
    $voucher;

    function addRental($carID, $startDateTime, $endDateTime){
        $addRentalQuery = "INSERT INTO rentals VALUES (null, '" . $_SESSION["UID"] . "', '$carID', '$startDateTime', '$endDateTime');";
    }

    function updateCarAvailability($conn, $carID){
        $updateCarAvailable = "UPDATE cars SET Availability = 0 WHERE CarID = '$carID'";

        if($execQuery = mysqli_query($conn, $updateCarAvailable)){
            echo $execQuery;
        }
    }

    if(isset($_POST)){
        $carID = $_POST["carID"];
        $pickUpLocation = $_POST["pickUpLocation"];
        $dropOffLocation = $_POST["dropOffLocation"];
        $startDateTime = $_POST["startDateTime"];
        $endDateTime = $_POST["endDateTime"];
        $paymentMethod = $_POST["paymentMethod"];
        $amountPaid = $_POST["amountPaid"];
        $voucher = $_POST["voucher"];
        updateCarAvailability($conn, $carID);
    }
?>