<?php
    require_once("../database/db_conn.php");

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
                            <select id='brand' name='carBrand' required></select>
                            <label for='brand'>Brand</label>
                        </span>
                    </span>

                    <select id='transmission' name='carTransmission' required>
                        <option value='None' selected disabled></option>
                        <option value='Manual'>Manual</option>
                        <option value='Automatic'>Automatic</option>
                        <option value='Continuously Variable'>Continuously Variable</option>
                        <option value='Semi-Automatic'>Semi-Automatic</option>
                        <option value='Dual Clutch'>Dual Clutch</option>
                    </select>
                    <label for='transmission'>Transmission</label>

                    <select id='fueltype' name='carFuelType' required>
                        <option value='None' selected disabled></option>
                        <option value='Gasoline'>Gasoline</option>
                        <option value='Diesel'>Diesel</option>
                        <option value='Electric'>Electric</option>
                    </select>
                    <label for='fueltype'>Fuel Type</label>

                    <select id='location' name='carLocation' required></select>
                    <label for='transmission'>Location</label>

                    <span class='availAndPrice'>
                        <span>
                            <select id='availability' required>
                                <option value='None' selected disabled></option>
                                <option value='1'>Available</option>
                                <option value='0'>Not Available</option>
                            </select>
                            <label for='availability'>Availability</label>
                        </span>
                        <span>
                            <input type='text' id='priceDay' name='rentalPriceDay' value='₱' required>
                            <label for='transmission'>Price/Day</label>
                        </span>
                    </span>

                    <span class='forCarImg'>
                        <input type='file' name='file' accept='image/jpg, image/jpeg, image/png' id='carImgInput'>
                        <label for='carImgInput'>Insert Car Image</label>
                    </span>

                    <button type='submit' name='submitCar' class='submitBtn' onclick='submitAddCar(event)'>Add Vehicle</button>
                    <image class='carImg' src='./images/icons/image-icon.svg'></image> <!-- height 150, width 150 -->
                    <p class='addCarErrorMsg'>Accepted Image Ratio is 3:2</p>
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
                    <button class='submitBtn' onclick='addBrand()'>Add Brand</button>
                    <p class='addBrandErrorMsg'></p>
                </form>
            </div>

            <span class='addLocationsDisabler' style='position: fixed; top: 0px; left: 0px; background-color: #031A09; height: 100dvh; width: 100dvw; display: none; z-index: 999; opacity: 0.8;' onclick='document.querySelector(&#x27;.addLocationsDisabler&#x27;).style.display = &#x27;none&#x27;'></span>
            <div popover id='addLocations'>
                <button popovertarget='addLocations' popovertargetaction='hide' class='exitButton' onclick='document.querySelector(&#x27;.addLocationsDisabler&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                <form class='addLocationsForm' method='post' onsubmit='return false'>
                    <input type='text' id='newLocation' name='newLocation' required>
                    <label for='newLocation'>New Location</label>
                    <span class='addLocationsList'>
                        <p>Locations List</p>
                        <span class='locationsList'></span>
                    </span>
                    <button class='submitBtn' onclick='addLocation()'>Add Location</button>
                    <p class='addLocationErrorMsg'></p>
                </form>
            </div>

            <div popover id='editPane'>
                <button popovertarget='editPane' popovertargetaction='hide' class='exitEditPane' onclick='editAction(this.id, &#x27;cancel&#x27;)'>&#215;</button>
                <span>
                    <p>Edit Brand</p>
                    <p id='editMsg'>Ford</p>
                    <input type='text' id='editBrandField'>
                    <label for='editBrandField'>New Brand</label>
                    <button popovertarget='editPane' popovertargetaction='hide' class='submitEditPane' onclick='editAction(this.title, &#x27;edit&#x27;)'>Confirm</button>
                </span>
            </div>
            <div popover id='editPaneLocation'>
                <button popovertarget='editPaneLocation' popovertargetaction='hide' class='exitEditPaneLocation' onclick='editActionLocation(this.title, &#x27;cancel&#x27;)'>&#215;</button>
                <span>
                    <p>Edit Location</p>
                    <p id='editLocationName'>Japan</p>
                    <input type='text' id='editLocationField'>
                    <label for='editBrandField'>New Location</label>
                    <button popovertarget='editPaneLocation' popovertargetaction='hide' class='submitEditPaneLocation' onclick='editActionLocation(this.title, &#x27;edit&#x27;)'>Confirm</button>
                </span>
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
        $rentalPrice = filter_input(INPUT_POST, "rentalPriceDay", FILTER_SANITIZE_SPECIAL_CHARS);

        $file = $_FILES["file"]["name"];
        $ffile = $_FILES["file"]["tmp_name"];
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $fileNameExist = true;
        do{
            $query = "SELECT ImageName FROM cars WHERE ImageName = '$file';";

            try{
                $execQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($execQuery) == 0){
                    $fileNameExist = false;
                }else{
                    $file = substr($file, 0, strlen($file) - strlen($fileExtension) -1) . "A." . $fileExtension;
                }
            }catch(mysqli_sql_exception){
                echo "Error Database Pre";
            }
        }while($fileNameExist);

        $path = "./images/cars/" . $file;
        
        try{
            $query = "INSERT INTO cars VALUES (null, 2, '$model', '$fuelType', '$transmission', '$rentalPrice', 1, 0, '$file')";
            
            mysqli_query($conn, $query);
            if(move_uploaded_file($ffile, $path)){
                echo "Ok";
            }else{
                echo "Error pre";
            }
        }catch(mysqli_sql_exception){
            echo "Error Database Pre";
        }
    }
?>