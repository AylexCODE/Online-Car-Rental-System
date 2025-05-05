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
                echo "<form id='notifData'>
                        <input type='hidden' name='name' value = '" . $rentalInfo["Name"] . "'>
                        <input type='hidden' name='email' value = '" . $rentalInfo["Email"] . "'>
                        <input type='hidden' name='car_name' value = '" . $rentalInfo["Car"] . "'>
                        <input type='hidden' name='pickup_location' value = '" . $rentalInfo["PickupLocation"] . "'>
                        <input type='hidden' name='pickup_time' value = '" . $rentalInfo["StartDate"] . "'>
                        <input type='hidden' name='dropoff_location' value = '" . $rentalInfo["DropoffLocation"] . "'>
                        <input type='hidden' name='dropoff_time' value = '" . $rentalInfo["EndDate"] . "'>
                        <input type='hidden' name='subject' value='Rental Receipt'>
                      </form>";
            }
        }catch(mysqli_sql_exception $e){
            echo $e;
        }
    }
?>