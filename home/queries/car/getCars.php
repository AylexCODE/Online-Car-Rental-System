<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $carsQuery = "SELECT cars.CarID, brands.BrandName, cars.Model, cars.FuelType, cars.Transmission, cars.RentalPrice, cars.LocationID, cars.Availability, cars.ImageName FROM cars INNER JOIN brands ON cars.BrandID = brands.BrandID";
        // Image Dimensions height: 180px | width: 277.5px;
        try{
            $execQuery = mysqli_query($conn, $carsQuery);
            if(mysqli_num_rows($execQuery) != 0){
                while($rows = mysqli_fetch_assoc($execQuery)){
                    echo "<span class='car' title='" . $rows[""] . "'>
                        <img src='./images/cars/" . $rows["ImageName"] . "' id='carImg'></img>
                        <p><span id='carBrand'>" . $rows[""] . "</span><span id='carModel'>" . $rows[""] . "</span></p>
                        <p>₱3000/Day</p>
                        <span>
                            <img src='./images/icons/location-icon.svg' height='14px' width='14px'><p>Cebu</p>
                        </span>
                        <span>
                            <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p>Continuously Variable</p>
                        </span>
                        <span>
                            <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p>Gasoline</p>
                        </span>
                        <span>";
                        if(isset($_SESSION["role"])){
                            if($_SESSION["role"] == "Customer"){
                                echo "<button>Rent</button>";
                            }else{
                                echo "<button>Edit</button>";
                            }
                        }else{
                            echo "<button onclick='toggleSignupAlert(&#x27;show&#x27;)'>Rent</button>";
                        }
                        echo "</span>
                    </span>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "Error Database Pre";
        }
    }
?>