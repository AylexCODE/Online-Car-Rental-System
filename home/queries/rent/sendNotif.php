<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $carID = $_POST["carID"];
        $userID = $_POST["userID"];

        $getUserInfoQuery = "SELECT users.Name, users.Email, CONCAT((SELECT BrandName FROM brands WHERE BrandID = (SELECT BrandID FROM cars WHERE CarID = rentals.CarID)), (SELECT ModelName FROM models WHERE ModelID = (SELECT ModelID FROM cars WHERE CarID = rentals.CarID))) AS Car, (SELECT Address FROM locations WHERE LocationID = rentals.PickUpLocationID) AS PickupLocation, (SELECT Address FROM locations WHERE LocationID = rentals.DropOffLocationID) AS DropoffLocation, rentals.StartDate, rentals.EndDate FROM users INNER JOIN rentals ON users.UserID = '$userID';";
        try{

            $execGetUserInfoQuery = mysqli_query($conn, $getUserInfoQuery);
            if(mysqli_num_rows($execGetUserInfoQuery)){
                $rentalInfo = mysqli_fetch_assoc($execGetUserInfoQuery);
                echo json_encode("{Name: \"" . $rentalInfo["Name"] . "\",
                        Email: \"" . $rentalInfo["Email"] . "\",
                        Car: \"" . $rentalInfo["Car"] . "\",
                        PickupLocation: \"" . $rentalInfo["PickupLocation"] . "\",
                        StartDate: \"" . $rentalInfo["StartDate"] . "\",
                        DropoffLocation: \"" . $rentalInfo["DropoffLocation"] . "\",
                        EndDate: \"" . $rentalInfo["EndDate"] . "\"}");
            }
        }catch(mysqli_sql_exception $e){
            echo $e;
        }
    }
?>