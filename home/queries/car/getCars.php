<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $carsQuery = "SELECT car.CarID, brands.BrandName, car.Model, car.FuelType, car.Transmission, car.RentalPrice, (SELECT locations.Address FROM locations WHERE locations.LocationID = car.LocationID) Address, car.Availability, car.ImageName FROM cars car INNER JOIN brands ON car.BrandID = brands.BrandID";
        // Image Dimensions height: 180px | width: 277.5px;
        try{
            $execQuery = mysqli_query($conn, $carsQuery);
            if(mysqli_num_rows($execQuery) != 0){
                while($rows = mysqli_fetch_assoc($execQuery)){
                    echo "<span class='car' title='" . $rows["CarID"] . "'>
                        <img src='./images/cars/" . $rows["ImageName"] . "' id='" . $rows["ImageName"] . "'></img>
                        <p><span id='carBrand'>" . $rows["BrandName"] . "</span>&nbsp;<span id='carModel'>" . $rows["Model"] . "</span></p>
                        <p id='carPrice'>₱" . $rows["RentalPrice"] . "</p>
                        <span>
                            <img src='./images/icons/location-icon.svg' height='14px' width='14px'><p id='carLocation'>" . $rows["Address"] . "</p>
                        </span>
                        <span>
                            <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p id='carTransmission'>" . $rows["Transmission"] . "</p>
                        </span>
                        <span>
                            <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p id='carFueltype'>" . $rows["FuelType"] . "</p>
                        </span>
                        <span>";
                        if(isset($_SESSION["role"])){
                            if($_SESSION["role"] == "Customer"){
                                echo $rows["Availability"] == 0 ? "<button class='notAvailable'>Rent</button>" :"<button>Rent</button>";
                            }else{
                                echo "<button onclick='editCar(&#x27;" . $rows["CarID"] . "&#x27;,&#x27;" . $rows["ImageName"] . "&#x27;,&#x27;" . $rows["BrandName"] . "&#x27;,&#x27;" . $rows["Model"] . "&#x27;,&#x27;" . $rows["RentalPrice"] . "&#x27;,&#x27;" . $rows["Address"] . "&#x27;,&#x27;" . $rows["Transmission"] . "&#x27;,&#x27;" . $rows["FuelType"] . "&#x27;,&#x27;" . $rows["Availability"] . "&#x27;)'>Edit</button>";
                            }
                        }else{
                            echo $rows["Availability"] == 0 ? "<button class='notAvailable' onclick='toggleSignupAlert(&#x27;show&#x27;);'>Rent</button>" :"<button onclick='toggleSignupAlert(&#x27;show&#x27;)'>Rent</button>";
                        }
                        echo "</span>
                    </span>";
                }
            }
        }catch(mysqli_sql_exception $e){
            echo "Error Database Pre";
            echo $e;
        }
    }
?>