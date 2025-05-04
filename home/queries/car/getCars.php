<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){ // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
        $type = $_POST["type"];
        $from = $_POST["from"];
    
        if($type == "getCars"){
            $carsQuery = "";
            
            if($from == "customer"){
                $filterTransmission = $_POST["transmission"];
                $filterBrand = $_POST["brand"];
                $filterFuelType = $_POST["fuelType"];
                $filterModel = $_POST["model"];
                $filterSort = $_POST["sortBy"];
                
                $fTransmission = "";
                $fBrand = "car.BrandID > 0";
                $fFuelType = "";
                $fModel = "";
                $fSortOrder = "";
               
                if($filterTransmission != ""){
                    $fTransmission = "AND car.Transmission = '$filterTransmission'";
                }
                if($filterBrand != ""){
                    $fBrand = "car.BrandID = (SELECT BrandID FROM brands WHERE BrandName = '$filterBrand')";
                }
                if($filterFuelType != ""){
                    $fFuelType = "AND car.FuelType = '$filterFuelType'";
                }
                if($filterModel != ""){
                    $fModel = "AND car.ModelID = (SELECT ModelID FROM models WHERE ModelName = '$filterModel')";
                }
                if($filterSort != ""){
                    $filterOrder = $_POST["orderBy"];
                    $fSortOrder = "ORDER BY car.$filterSort $filterOrder";
                }
                
                $carsQuery = "SELECT car.CarID, (SELECT brands.BrandName from brands WHERE brands.BrandID = car.BrandID) AS BrandName, (SELECT models.ModelName from models WHERE models.ModelID = car.ModelID) AS Model, car.FuelType, car.Transmission, car.RentalPrice, (SELECT rentals.EndDate FROM rentals WHERE rentals.carID = car.carID ORDER BY rentals.RentalID DESC LIMIT 1) RentalStatus, car.Availability, car.ImageName FROM cars car INNER JOIN brands ON car.BrandID = brands.BrandID WHERE $fBrand $fTransmission $fModel $fFuelType $fSortOrder";
            }
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
            }catch(mysqli_sql_exception $e){
                echo "Error Database Pre";
                echo $e;
            }
        }elseif($type == "getFilterBrand"){
            $getFilterQuery = "SELECT BrandName FROM brands ORDER BY BrandName";
            
            $execGetFilterQuery = mysqli_query($conn, $getFilterQuery);
            if(mysqli_num_rows($execGetFilterQuery) > 0){
                while($brands = mysqli_fetch_assoc($execGetFilterQuery)){
                     echo "<option value='" . $brands["BrandName"] . "'>" . $brands["BrandName"] . "</option>";
                }
            }else{
                echo "<option>No Brands yet...</option>";
            }
        }elseif($type == "getFilterModel"){
            $fromBrand = $_POST["fromBrand"];
            
            $vrand = "models.BrandID > 0";
            if($fromBrand != ""){
                $vrand = "models.BrandID = (SELECT BrandID FROM brands WHERE BrandName = '$fromBrand')";
            }
            $getFilterQuery = "SELECT ModelName FROM models WHERE $vrand ORDER BY ModelName";
            
            $execGetFilterQuery = mysqli_query($conn, $getFilterQuery);
            if(mysqli_num_rows($execGetFilterQuery) > 0){
                while($models = mysqli_fetch_assoc($execGetFilterQuery)){
                     echo "<option value='" . $models["ModelName"] . "'>" . $models["ModelName"] . "</option>";
                }
            }else{
                echo "<option>No Models yet...</option>";
            }
        }
    }
?>