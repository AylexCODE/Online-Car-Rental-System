<?php
    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_POST)){
        $rentalID = filter_var($_POST["rentalID"], FILTER_SANITIZE_SPECIAL_CHARS);
        $user = filter_var($_POST["user"], FILTER_SANITIZE_SPECIAL_CHARS);
        $car = filter_var($_POST["car"], FILTER_SANITIZE_SPECIAL_CHARS);
        $pickUpDate = filter_var($_POST["pickUpDate"], FILTER_SANITIZE_SPECIAL_CHARS);
        $dropOffDate = filter_var($_POST["dropOffDate"], FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_var($_POST["status"], FILTER_SANITIZE_SPECIAL_CHARS);

        $getActiveRentalQuery = "";
        if($_POST["type"] == "active"){
            $getActiveRentalQuery = "SELECT rentals.RentalID, (SELECT users.Name FROM users WHERE UserID = rentals.UserID) AS User, (SELECT models.ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, (SELECT brands.BrandName FROM brands WHERE brands.BrandID = cars.BrandID) AS Brand, rentals.CarID, rentals.StartDate, rentals.EndDate, rentals.Status FROM rentals INNER JOIN cars ON rentals.CarID = cars.CarID WHERE rentals.Status = 0 OR rentals.Status = 1;";
        }else{
            $getActiveRentalQuery = "SELECT rentals.RentalID, (SELECT users.Name FROM users WHERE UserID = rentals.UserID) AS User, (SELECT models.ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, (SELECT brands.BrandName FROM brands WHERE brands.BrandID = cars.BrandID) AS Brand, rentals.StartDate, rentals.EndDate, rentals.Status FROM rentals INNER JOIN cars ON rentals.CarID = cars.CarID WHERE rentals.Status = 3 OR rentals.Status = 4 OR rentals.Status = 5;";
        }

        try{
            if($execGetRentals = mysqli_query($conn, $getActiveRentalQuery)){
                while($rental = mysqli_fetch_assoc($execGetRentals)){
                    $status = "";
                    switch($rental["Status"]){
                        case 0:
                            $status = "Pending";
                            break;
                        case 1:
                            $status = "Confirmed";
                            break;
                        case 3:
                            $status = "Completed";
                            break;
                        case 4:
                            $status = "Cancelled";
                            break;
                        case 5:
                            $status = "Declined";
                            break;
                    }

                    echo "<tr>
                    <td>" . $rental["RentalID"] . "</td>
                    <td>" . $rental["User"] . "</td>
                    <td>" . $rental["Model"] . "&nbsp;" . $rental["Brand"] . "</td>
                    <td>" . $rental["StartDate"] . "</td>
                    <td>" . $rental["EndDate"] . "</td>
                    <td class='activeRentalstatusAction'>"; if($status == "Pending") { echo "<button onclick='activeRentAction(1, " . $rental["RentalID"] . "'NA');'>Confirm</button><button onclick='activeRentAction(5, " . $rental["RentalID"] . ", " . $rental["CarID"] . ");'>Decline</button>"; }else{ echo $status; } echo "</td>
                    </tr>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "Error";
        }
    }
?>