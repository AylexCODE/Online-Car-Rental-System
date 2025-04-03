<?php
    $queryGetBrands = "SELECT * FROM brands ORDER BY BrandName";

    echo "<div class='vehicleManagement active'>
            <h4>Vehicle Management</h4>
            <span>
                <span>
                </span>
                <span>
                    <span>
                        <button popovertarget='addCars' onclick='document.querySelector(&#x27;.addCarsDisabler&#x27;).style.display = &#x27;block&#x27;'>Add Vehicle</button>
                        <button popovertarget='addBrands' onclick='document.querySelector(&#x27;.addBrandsDisabler&#x27;).style.display = &#x27;block&#x27;'>Add Brands</button>
                        <button popovertarget='addLocations' onclick='document.querySelector(&#x27;.addLocationsDisabler&#x27;).style.display = &#x27;block&#x27;'>Add Location</button>
                    </span>
                    <span>";
    include_once("./components/cars.php");
    echo "</span>
                </span>
            </span>
            <span class='addCarsDisabler' style='position: fixed; top: 0px; left: 0px; background-color: #031A09; height: 100dvh; width: 100dvw; display: none; z-index: 999; opacity: 0.8;' onclick='document.querySelector(&#x27;.addCarsDisabler&#x27;).style.display = &#x27;none&#x27;'></span>
            <div popover id='addCars'>
                <button popovertarget='addCars' popovertargetaction='hide' class='exitButton' onclick='document.querySelector(&#x27;.addCarsDisabler&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                <form method='post' enctype='multipart/form-data' class='addCarsForm'>
                    <span>
                        <span>
                            <input type='text' id='model' name='carModel' required>
                            <label for='model'>Model</label>
                        </span>
                        <span>
                            <select id='brand' name='carBrand'></select>
                            <label for='brand'>Brand</label>
                        </span>
                    </span>

                    <select id='transmission' name='carTransmission'>
                        <option value='None' selected disabled></option>
                        <option value='Manual'>Manual</option>
                        <option value='Automatic'>Automatic</option>
                        <option value='Continuously Variable'>Continuously Variable</option>
                        <option value='Semi-Automatic'>Semi-Automatic</option>
                        <option value='Dual Clutch'>Dual Clutch</option>
                    </select>
                    <label for='transmission'>Transmission</label>

                    <select id='fueltype' name='carFuelType'>
                        <option value='None' selected disabled></option>
                        <option value='Gasoline'>Gasoline</option>
                        <option value='Diesel'>Diesel</option>
                        <option value='Electric'>Electric</option>
                    </select>
                    <label for='fueltype'>Fuel Type</label>

                    <input type='file' name='file'>
                    <button type='submit' name='submitCar'>Add Car</button>
                </form>
            </div>

            <span class='addBrandsDisabler' style='position: fixed; top: 0px; left: 0px; background-color: #031A09; height: 100dvh; width: 100dvw; display: none; z-index: 999; opacity: 0.8;' onclick='document.querySelector(&#x27;.addBrandsDisabler&#x27;).style.display = &#x27;none&#x27;'></span>
            <div popover id='addBrands'>
                <button popovertarget='addBrands' popovertargetaction='hide' class='exitButton' onclick='document.querySelector(&#x27;.addBrandsDisabler&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                <form method='post' class='addBrandsForm'>
                    <input type='text' id='newBrand' name='newBrand' required>
                    <label for='newBrand'>New Brand</label>
                    <span class='addBrandsList'>
                        <p>Brands List</p>
                        <span class='brandsList'></span>
                    </span>
                    <div class='submitBtn' onclick='addBrand()'>Add Brand</div>
                </form>
            </div>

            <span class='addLocationsDisabler' style='position: fixed; top: 0px; left: 0px; background-color: #031A09; height: 100dvh; width: 100dvw; display: none; z-index: 999; opacity: 0.8;' onclick='document.querySelector(&#x27;.addLocationsDisabler&#x27;).style.display = &#x27;none&#x27;'></span>
            <div popover id='addLocations'>
                <button popovertarget='addLocations' popovertargetaction='hide' class='exitButton' onclick='document.querySelector(&#x27;.addLocationsDisabler&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                <form class='addLocationsForm' method='post'>
                    <input type='text' id='newLocation' name='newLocation' required>
                    <label for='newLocation'>New Location</label>
                    <span class='addLocationsList'>
                        <p>Locations List</p>
                        <span class='locationsList'></span>
                    </span>
                    <div class='submitBtn' onclick='addLocation()'>Add Location</div>
                </form>
            </div>

            <div popover id='deleteConfirmation'>
                <button popovertarget='deleteConfirmation' popovertargetaction='hide' class='exitConfirmation' onclick='deleteAction(&#x27;cancel&#x27;, this.id)'>&#215;</button>
                <span>
                    <p id='deleteMsg'p>Are you sure to delete this?</p>
                    <p id='deleteName'>Toyota</p>
                    <button popovertarget='deleteConfirmation' popovertargetaction='hide' class='confirmDelete' onclick='deleteAction(&#x27;delete&#x27;, this.id, this.title)'>Confirm</button>
                </span>
            </div>
        </div>";

    if(isset($_POST["submitCar"])){
        $model = filter_input(INPUT_POST, "carModel", FILTER_SANITIZE_SPECIAL_CHARS);
        $brand = filter_input(INPUT_POST, "carBrand", FILTER_SANITIZE_SPECIAL_CHARS);
        $transmission = filter_input(INPUT_POST, "carTransmission", FILTER_SANITIZE_SPECIAL_CHARS);
        $fuelType = filter_input(INPUT_POST, "carFuelType", FILTER_SANITIZE_SPECIAL_CHARS);

        $file = $_FILES["file"]["name"];
        $ffile = $_FILES["file"]["tmp_name"];
        $path = "./images/cars/" . $file;

        $query = "INSERT INTO cars VALUES (null, $brand, $model, $fuelType, $transmission, 999, 1, 0, $file)";

        if(move_uploaded_file($ffile, $path)){
            echo "Ok";
        }else{
            echo "Error pre";
        }
    }
?>