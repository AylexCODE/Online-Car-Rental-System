<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){ // Rentals status 0 = pending; 1 = ongoing; 2 = completed; 3 = cancelled
        $carsQuery = "SELECT car.CarID, (SELECT brands.BrandName from brands WHERE brands.BrandID = car.BrandID) AS BrandName, (SELECT models.ModelName from models WHERE models.ModelID = car.ModelID) AS Model, car.FuelType, car.Transmission, car.RentalPrice, (SELECT rentals.EndDate FROM rentals WHERE rentals.carID = car.carID) RentalStatus, car.Availability, car.ImageName FROM cars car INNER JOIN brands ON car.BrandID = brands.BrandID";
        // Image Dimensions height: 180px | width: 277.5px;
        try{
            $execQuery = mysqli_query($conn, $carsQuery);
            if(mysqli_num_rows($execQuery) != 0){
                while($rows = mysqli_fetch_assoc($execQuery)){
                    echo "<span class='car' title='" . $rows["BrandName"] . " " . $rows["Model"] . "'>
                        <img src='./images/cars/" . $rows["ImageName"] . "' id='" . $rows["ImageName"] . "'></img>
                        <p><span id='carBrand'>" . $rows["BrandName"] . "</span>&nbsp;<span id='carModel'>" . $rows["Model"] . "</span></p>
                        <p id='carPrice'>₱" . $rows["RentalPrice"] . "</p>
                        <span>
                            <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p id='carFueltype'>" . $rows["FuelType"] . "</p>
                        </span>
                        <span>
                            <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p id='carTransmission'>" . $rows["Transmission"] . "</p>
                        </span>
                        <span>
                            <img src='./images/icons/availability-icon.svg' height='14px' width='14px'><p id='availabilityStatus'>"; echo $rows["Availability"] == 0 ? "Available in: " . substr($rows["RentalStatus"], 0, 10) . "&nbsp;(Estimate)" : "Available";  echo "</p>
                        </span>
                        <span>";
                        if(isset($_SESSION["role"])){
                            if($_SESSION["role"] == "Customer"){
                                echo $rows["Availability"] == 0 ? "<button class='notAvailable'>Rent</button>" :"<button onclick='toggleRentPage(&#x27;" . $rows["CarID"] . "&#x27;,&#x27;" . $rows["BrandName"] . "&#x27;,&#x27;" . $rows["Model"] . "&#x27;,&#x27;" . $rows["RentalPrice"] . "&#x27;,&#x27;" . $rows["Transmission"] . "&#x27;,&#x27;" . $rows["FuelType"] . "&#x27;,&#x27;" . $rows["ImageName"] . "&#x27;);'>Rent</button>";
                            }else{
                                echo "<button onclick='editCar(&#x27;" . $rows["CarID"] . "&#x27;,&#x27;" . $rows["ImageName"] . "&#x27;,&#x27;" . $rows["BrandName"] . "&#x27;,&#x27;" . $rows["Model"] . "&#x27;,&#x27;" . $rows["RentalPrice"] . "&#x27;,&#x27;" . $rows["Transmission"] . "&#x27;,&#x27;" . $rows["FuelType"] . "&#x27;,&#x27;" . $rows["Availability"] . "&#x27;)'>Edit</button>";
                            }
                        }else{
                            echo $rows["Availability"] == 0 ? "<button class='notAvailable' onclick='toggleSignupAlert(&#x27;show&#x27;);'>Rent</button>" :"<button onclick='toggleSignupAlert(&#x27;show&#x27;)'>Rent</button>";
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

<script type="text/javascript">
    async function toggleRentPage(carID, brandName, modelName, rentalPrice, transmission, fuelType, imgUrl){
        await getLocationsForRent();

        setInitialRentInfo(carID, brandName, modelName, rentalPrice, transmission, fuelType, "./images/cars/" +imgUrl);

        document.querySelector(".homePageWrapper").style.display = "none";
        document.querySelector(".rentPage").style.display = "block";
    }
</script>