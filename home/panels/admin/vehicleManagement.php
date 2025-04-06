<?php
    require_once("../database/db_conn.php");

    echo "<div class='vehicleManagement active'>
            <h4>Vehicle Management</h4>
            <span>
                <span>
                </span>
                <span>
                    <span>
                        <button onclick='setActiveManagementPane(&#x27;addCars&#x27;)'>Add Vehicle</button><!--popovertarget='addCars'-->
                        <button onclick='setActiveManagementPane(&#x27;addBrands&#x27;)'>Add Brands</button><!--popovertarget='addBrands'-->
                        <button onclick='setActiveManagementPane(&#x27;addLocations&#x27;)'>Add Location</button><!--popovertarget='addLocations'-->
                    </span>
                    <span>";
    include_once("./components/cars.php");
    echo "</span>
                </span>
            </span>
            <span class='popOverCover' style='position: fixed; top: 0px; left: 0px; background-color: #031A09; height: 100dvh; width: 100dvw; display: none; z-index: 99; opacity: 0.8;' onclick='setActiveManagementPane(&#x27;none&#x27;)'></span>
            <span class='popOver' style='position: fixed; top: 0px; right: 0px; height: 100dvh; width: 80dvw; display: none; z-index: 100; pointer-events:none; place-items: center;'>
                <div id='addCars'><!--popover-->
                    <button class='exitButton' onclick='setActiveManagementPane(&#x27;none&#x27)'>&#215;</button>
                    <form method='post' enctype='multipart/form-data' class='addCarsForm'>
                        <p class='addCarHeader'>New Vehicle</p>
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
                            <option value='None' id='selectedTransmission' selected disabled></option>
                            <option value='Manual'>Manual</option>
                            <option value='Automatic'>Automatic</option>
                            <option value='Continuously Variable'>Continuously Variable</option>
                            <option value='Semi-Automatic'>Semi-Automatic</option>
                            <option value='Dual Clutch'>Dual Clutch</option>
                        </select>
                        <label for='transmission'>Transmission</label>

                        <select id='fueltype' name='carFuelType' required>
                            <option value='None' id='selectedFuelType' selected disabled></option>
                            <option value='Gasoline'>Gasoline</option>
                            <option value='Diesel'>Diesel</option>
                            <option value='Electric'>Electric</option>
                        </select>
                        <label for='fueltype'>Fuel Type</label>

                        <select id='location' name='carLocation' required></select>
                        <label for='transmission'>Location</label>

                        <span class='availAndPrice'>
                            <span>
                                <select id='availability' name='carAvailability' required>
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

                <div id='addBrands'><!--popover-->
                    <button class='exitButton' onclick='setActiveManagementPane(&#x27;none&#x27)'>&#215;</button>
                    <form method='post' class='addBrandsForm' onsubmit='return false'>
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

                <div id='addLocations'><!--popover-->
                    <button class='exitButton' onclick='setActiveManagementPane(&#x27;none&#x27)'>&#215;</button>
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

                <div id='editPane'><!--popover-->
                    <button class='exitEditPane' onclick='editAction(this.id, &#x27;cancel&#x27;); setActiveManagementPane(&#x27;addBrands&#x27;);'>&#215;</button>
                    <span>
                        <p>Edit Brand</p>
                        <p id='editMsg'>Ford</p>
                        <input type='text' id='editBrandField'>
                        <label for='editBrandField'>New Brand</label>
                        <button class='submitEditPane' onclick='editAction(this.title, &#x27;edit&#x27;); setActiveManagementPane(&#x27;addBrands&#x27;);'>Confirm</button>
                    </span>
                </div>
                <div id='editPaneLocation'><!--popover-->
                    <button class='exitEditPaneLocation' onclick='editActionLocation(this.title, &#x27;cancel&#x27;); setActiveManagementPane(&#x27;addLocations&#x27;);'>&#215;</button>
                    <span>
                        <p>Edit Location</p>
                        <p id='editLocationName'>Japan</p>
                        <input type='text' id='editLocationField'>
                        <label for='editBrandField'>New Location</label>
                        <button class='submitEditPaneLocation' onclick='editActionLocation(this.title, &#x27;edit&#x27;);  setActiveManagementPane(&#x27;addLocations&#x27;);'>Confirm</button>
                    </span>
                </div>
                <div id='deleteConfirmation'><!--popover-->
                    <button class='exitConfirmation' onclick='deleteAction(&#x27;cancel&#x27;, this.id); setActiveManagementPane(this.id);'>&#215;</button>
                    <span>
                        <p id='deleteMsg'p>Are you sure to delete this?</p>
                        <p id='deleteName'>Toyota</p>
                        <button class='confirmDelete' onclick='deleteAction(&#x27;delete&#x27;, this.id, this.title); setActiveManagementPane(this.id);'>Confirm</button>
                    </span>
                </div>
            </span>
        </div>";
    include_once("./queries/car/addCar.php");
?>