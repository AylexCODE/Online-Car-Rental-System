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

        $filterRentalID = "";
        $filterUser = "";
        $filterCar = "";
        $filterPickUpDate = "";
        $filterDropOffDate = "";
        $filterStatus = "";
        if(trim($rentalID) !=  ""){
            $filterRentalID = "AND rentals.RentalID LIKE '%$rentalID%'";
        }if(trim($user) !=  ""){
            $filterUser = "AND rentals.UserID = (SELECT UserID FROM users WHERE Name LIKE '%$user%' AND Role = 'Customer' LIMIT 1)";
        }if(trim($car) !=  ""){
            if(count(explode(" ", $car)) > 1){
                $filterCar = "AND rentals.CarID = (SELECT CarID FROM cars WHERE cars.BrandID = (SELECT BrandID FROM brands WHERE BrandName LIKE '%" . explode(" ", $car)[0] . "%' LIMIT 1) AND cars.ModelID = (SELECT ModelID FROM models WHERE ModelName LIKE '%" . explode(" ", $car)[1] . "%' LIMIT 1))";
            }
        }if(trim($pickUpDate) !=  ""){
            $filterPickUpDate = "AND rentals.StartDate LIKE '$pickUpDate%'";
        }if(trim($dropOffDate) !=  ""){
            $filterDropOffDate = "AND rentals.EndDate LIKE '$dropOffDate%'";
        }if(trim($status) !=  ""){
            $filterStatus = "AND rentals.Status = '$status'";
        }

        $getRentalsQuery = "";
        if($_POST["type"] == "active"){
            $getRentalsQuery = "SELECT rentals.RentalID, (SELECT users.Name FROM users WHERE UserID = rentals.UserID) AS User, (SELECT models.ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, (SELECT brands.BrandName FROM brands WHERE brands.BrandID = cars.BrandID) AS Brand, rentals.CarID, rentals.StartDate, rentals.EndDate, rentals.Status FROM rentals INNER JOIN cars ON rentals.CarID = cars.CarID WHERE rentals.Status = 0 OR rentals.Status = 1;";
        }else{
            $getRentalsQuery = "SELECT rentals.RentalID, (SELECT users.Name FROM users WHERE UserID = rentals.UserID) AS User, (SELECT models.ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, (SELECT brands.BrandName FROM brands WHERE brands.BrandID = cars.BrandID) AS Brand, rentals.StartDate, rentals.EndDate, rentals.Status FROM rentals INNER JOIN cars ON rentals.CarID = cars.CarID WHERE rentals.Status = 3 OR rentals.Status = 4 OR rentals.Status = 5 $filterRentalID $filterUser $filterCar $filterPickUpDate $filterDropOffDate $filterStatus;";
        }

        try{
            $execGetRentals = mysqli_query($conn, $getRentalsQuery);
            if(mysqli_num_rows($execGetRentals) > 0){
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
                    <td>" . $rental["Brand"] . "&nbsp;" . $rental["Model"] . "</td>
                    <td>" . $rental["StartDate"] . "</td>
                    <td>" . $rental["EndDate"] . "</td>
                    <td class='activeRentalstatusAction'>"; if($status == "Pending") { echo "<button onclick='activeRentAction(1, " . $rental["RentalID"] . "'NA');'>Confirm</button><button onclick='activeRentAction(5, " . $rental["RentalID"] . ", " . $rental["CarID"] . ");'>Decline</button>"; }else{ echo $status; } echo "</td>
                    </tr>";
                }
            }else{
                echo "<tr>
                        <td colspan='6' style='text-align: center;'>No Data</td>
                    </tr>";
            }
        }catch(mysqli_sql_exception $e){
            echo "Error";
            echo $e;
        }
    }
?>