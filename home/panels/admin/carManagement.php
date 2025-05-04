<?php
    require_once("../database/db_conn.php");

  echo "<div class='carManagement'>
            <h4>Car Management</h4>
            <span>
                <span id='carStatistics'>
                    <span>
                        <span onclick='setInfoTemplate(&#x27;ALL BRANDS&#x27;)'>
                            <p id='infoBrandLabel'>Total Brands</p>
                            <p id='infoBrandCount'>56</p>
                            <button>Tap for more info.</button>
                        </span>
                        <span onclick='setInfoTemplate(&#x27;ALL MODELS&#x27;)'>
                            <p id='infoModelLabel'>Total Models</p>
                            <p id='infoModelCount'>12</p>
                            <button>Tap for more info.</button>
                        </span>
                        <span onclick='setInfoTemplate(&#x27;ALL CARS&#x27;)'>
                            <p id='infoCarCountLabel'>Total Cars</p>
                            <p id='infoCarCount'>128</p>
                            <button>Tap for more info.</button>
                        </span>
                        <span onclick='getCarNeedsMaintenance();'>
                            <p id='infoMaintenanceLabel'>Cars Needs Maintenance</p>
                            <p id='infoCarMaintenance'>128</p>
                            <button>Tap for more info.</button>
                        </span>
                    </span>
                    <span class='recentCarActivity'>
                        <p>Recent Activities</p>
                        <table>
                            <thead>
                                <th>No.</th>
                                <th>Car</th>
                                <th>Customer Name</th>
                                <th>Cutomer Email</th>
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Damages</th>
                            <thead>
                            <tr class='recentCarActivityySearchBar'>
                                <td><input type='number' id='recentFilterId' oninput='getCarStats()'></td>
                                <td><input type='search' id='recentFilterBrandModel' oninput='getCarStats()'></td>
                                <td><input type='search' id='recentFilterName' oninput='getCarStats()'></td>
                                <td><input type='search' id='recentFilterEmail' oninput='getCarStats()'></td>
                                <td><input type='date' id='recentFilterDate' onchange='getCarStats()'></td>
                                <td>
                                    <select id='recentFilterType' onchange='getCarStats()'>
                                        <option value='All'>All</option>
                                        <option value='Return'>Return</option>
                                        <option value='Retrieve'>Retrieve</option>
                                    </select>
                                </td>
                                <td>
                                    <select id='recentFilterDmg' onchange='getCarStats()'>
                                        <option value='All'>All</option>
                                        <option value='No'>No</option>
                                        <option value='Yes'>Yes</option>
                                    </select>
                                </td>
                            </tr>
                            <tbody id='carStats'>
                                <tr>
                                    <td>1</td>
                                    <td>Ford    </td>
                                    <td>Ranger</td>
                                    <td>Lex</td>
                                    <td>lexcode@gmail.com</td>
                                    <td>Sept 16, 2025</td>
                                    <td>Return</td>
                                    <td>Scratches</td>
                                </tr>
                            </tbody>
                        </table>
                    </span>
                </span>
                
                <span id='carManagement'>
                    <span class='carFilters'>
                    </span>
                    <span>
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
        
                                <input type='text' id='newAddressCode' name='newAddressCode' required>
                                <label for='newAddressCode'>Address Code</label>
        
                                <input type='number' id='newDistance' step='0.01' name='newDistance' required>
                                <label for='newDistance'>Distance ( km )</label>
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
                    <span class='carInfoTemplate' style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; background-color: #031A0980; z-index: 100; display: none;'>
                        <span style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; z-index: 101;' onclick='document.querySelector(&#x27;.carInfoTemplate&#x27;).style.display = &#x27;none&#x27;'></span>
                        <span style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; z-index: 102; display: grid; place-items: center; pointer-events: none;'>
                            <div style='background-color: #38814a; border: 2px solid #E2F87B; border-radius: 5px; padding: 15px 20px; display: flex; flex-direction: column; pointer-events: all;'>
                                <button style='height: 10px; width: 0px; outline: none; border: none; align-self: flex-end; color: #E2F87B; transform: translateY(-10px);' onclick='document.querySelector(&#x27;.carInfoTemplate&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                                <p id='infoTemplateName' style='width: 100%; text-align: center; font-size: 20px; opacity: 0.8;'>ALL MODELS</p>
                                <span id='infoTemplateInfos' style='display: flex; flex-direction: column; border-top: 1px solid #FDFFF660; border-bottom: 1px solid #FDFFF660; padding-block: 10px; font-size: 10px; margin-top: 10px; height: 300px; overflow-y: scroll;'>
                                    <p>TOYOTA</p>
                                </span>
                            </div>
                        </span>
                    </span>
                    <span class='carMaintenancePanel' style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; background-color: #031A0980; z-index: 100; display: none;'>
                        <span style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; z-index: 101;' onclick='document.querySelector(&#x27;.carMaintenancePanel&#x27;).style.display = &#x27;none&#x27;'></span>
                        <span style='position: fixed; top: 0px; left: 0px; height: 100%; width: 100%; z-index: 102; display: grid; place-items: center; pointer-events: none;'>
                            <div style='background-color: #38814a; border: 2px solid #E2F87B; border-radius: 5px; padding: 15px 20px; display: flex; flex-direction: column; pointer-events: all; width: 70%; height: 80%;'>
                                <button style='height: 10px; width: 0px; outline: none; border: none; align-self: flex-end; color: #E2F87B; transform: translateY(-10px);' onclick='document.querySelector(&#x27;.carMaintenancePanel&#x27;).style.display = &#x27;none&#x27;'>&#215;</button>
                                <p id='infoTemplateName' style='width: 100%; text-align: left; font-size: 20px; opacity: 0.8;'>Needs Maintenance</p>
                                <input type='text' id='filterCarMaintenance' oninput='getCarNeedsMaintenance();' placeholder='Search Car Name' style='background-color: transparent; border: 1px solid ##E2F87B; border-radius: 5px; padding: 5px 10px; color: #FDFFF6; border: 1px solid #E2F87B;'>
                                <span id='carMaintenanceCard' style='display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; overflow-y: scroll; margin-top: 10px;'>
                                </span>
                            </div>
                        </span>
                    </span>
                </span>
            </span>
            <canvas id='tempCarImg' style='display: none;'>
        </div>";
    include_once("./queries/car/addCar.php");
?>

<script type="text/javascript">
    function setActiveManagementPane(name){
        const popoverCover = document.querySelector(".popOverCover"); popoverCover.style.display = "block";
        const popover = document.querySelector(".popOver"); popover.style.display = "grid";
        const addCars = document.getElementById("addCars"); addCars.style.display = "none";
        const addBrands = document.getElementById("addBrands"); addBrands.style.display = "none";
        const addLocations = document.getElementById("addLocations"); addLocations.style.display = "none";
        const editPane = document.getElementById("editPane"); editPane.style.display = "none";
        const editPaneLocation = document.getElementById("editPaneLocation"); editPaneLocation.style.display = "none";
        const deleteConfirmation = document.getElementById("deleteConfirmation"); deleteConfirmation.style.display = "none";
        
        document.querySelector(".addBrandErrorMsg").innerHTML = "";
        document.querySelector(".addLocationErrorMsg").innerHTML = "";
        document.querySelector(".addCarErrorMsg").innerHTML = "Accepted Image Ratio is 3:2";

        document.getElementById("selectedBrand").setAttribute("value", "None");
        document.getElementById("selectedBrand").innerHTML = "";

        switch(name){
            case "addCars":
                document.querySelector(".addCarHeader").innerHTML = "New Vehicle";
                addCars.style.display = "block";
                break;
            case "brands":
            case "addBrands":
                addBrands.style.display = "block";
                break;
            case "locations":
            case "addLocations":
                addLocations.style.display = "block";
                break;
            case "editPane":
                editPane.style.display = "block";
                break;
            case "editPaneLocation":
                editPaneLocation.style.display = "block";
                break;
            case "deleteConfirmation":
                deleteConfirmation.style.display = "block";
                break;
            default:
                popoverCover.style.display = "none";
                popover.style.display = "none";

        }
    }

    const infoTemplateName = document.getElementById("infoTemplateName");
    const infoTemplateInfos = document.getElementById("infoTemplateInfos");
    function setInfoTemplate(name){
        infoTemplateName.innerHTML = name;

        $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=' +name,
            success: function(res){
                infoTemplateInfos.innerHTML = res;
            }
        });

        document.querySelector(".carInfoTemplate").style.display = 'grid';
    }

    async function setInfos(){
        await $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=GetModelCount',
            success: function(res){
                $("#infoModelCount").html(res);
                if(res > 1){
                    $("#infoModelLabel").html("Total Models");
                }else{
                    $("#infoModelLabel").html("Total Model");
                }
            }
        });

        await $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=GetBrandCount',
            success: function(res){
                $("#infoBrandCount").html(res);
                if(res  > 1){
                    $("#infoBrandLabel").html("Total Brands");
                }else{
                    $("#infoBrandLabel").html("Total Brand");
                }
            }
        });

        await $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=GetCarCount',
            success: function(res){
                $("#infoCarCount").html(res);
                if(res > 1){
                    $("#infoCarCountLabel").html("Total Cars");
                }else{
                    $("#infoCarCountLabel").html("Total Car");
                }
            }
        });

        $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=maintenance',
            success: function(res){
                $("#infoCarMaintenance").html(res);
                if(res > 1){
                    $("#infoMaintenanceLabel").html("Cars Need Maintenance");
                }else{
                    $("#infoMaintenanceLabel").html("Car Need Maintenance");
                }
            }
        });
    }

    const filterCarMaintenance = document.getElementById("filterCarMaintenance");
    function getCarNeedsMaintenance(){
        $.ajax({
            type: 'get',
            url: './queries/car/getCarMaintenance.php?filterCarName=' +filterCarMaintenance.value,
            success: function(res){
                $("#carMaintenanceCard").html(res);
            },
            error: function(){}
        });

        $(".carMaintenancePanel").css('display', 'grid');
    }

    function fixCar(carID, dent, Scratches, Chipped, Cracked){
        $.ajax({
            type: 'post',
            url: './queries/car/fixCar.php',
            data: { carID: carID, dents: dent ? 0 : 1, scratches: Scratches ? 0 : 1, chippedPaint: Chipped ? 0 : 1, crackedWindshields: Cracked ? 0 : 1 },
            success: function(res){
                $(".msg").html("<p class='success'>Car Fixed</p>");
                getCarNeedsMaintenance();
            },
            error: function(){}
        });
    }

    setInfos();

    const recentFilterId = document.getElementById("recentFilterId");    
    const recentFilterBrandModel = document.getElementById("recentFilterBrandModel");
    const recentFilterName = document.getElementById("recentFilterName");
    const recentFilterEmail = document.getElementById("recentFilterEmail");
    const recentFilterDate = document.getElementById("recentFilterDate");
    const recentFilterType = document.getElementById("recentFilterType");
    const recentFilterDmg = document.getElementById("recentFilterDmg");

    function getCarStats(){
        $.ajax({
            type: 'post',
            url: './queries/car/getCarStatistics.php',
            data: { recentFilterId: recentFilterId.value, recentFilterBrandModel: recentFilterBrandModel.value, recentFilterName: recentFilterName.value, recentFilterEmail: recentFilterEmail.value, recentFilterDate: recentFilterDate.value, recentFilterType: recentFilterType.value, recentFilterDmg: recentFilterDmg.value },
            success: function(res){
                $("#carStats").html(res);
            },
            error: function(){}
        });
    }

    getCarStats();
</script>

<style type="text/css">
    .carManagement {
        height: 100%;
        width: 100%;
        display: none;
        overflow-y: hidden;
    }
    
    .carManagement > span {
        padding: 0px 25px;
        height: 100%;
        display: block;
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
    }
    
    .carManagement > span > span {
        scroll-snap-align: start;
    }
    
    #carManagement {
        display: flex;
        flex-direction: row;
        height: 100%;
        width: 100%;
        gap: 5px;
        padding-bottom: 10px;
    }
    
   .carFilters {
      height: 100%;
      width: 20%;
      background-color: #316C40;
      border-radius: 5px;
    }
    
    #carManagement > span:nth-child(2){
        width: 100%;
        height: 100%;
    }
    #carManagement > span:nth-child(2) > span {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        gap: 5px;
    }
    
    #carManagement > span:nth-child(2) > span > span:nth-child(2){
        border-radius: 5px;
        background-color: #316C40;
        height: calc(100% - 100px);
    }
    
    #carManagement > span:nth-child(2) > span > span:nth-child(1){
        display: flex;
        flex-direction: row;
        justify-content: left;
        align-items: center;
        border-radius: 5px;
        background-color: #316C40;
        height: 18%;
        width: 100%;
        padding-inline: 4%;
        gap: 3%;
    }
    
    #carManagement > span:nth-child(2) > span > span:nth-child(1) button {
        border: none;
        outline: none;
        background-color: #E2F87B;
        color: #031A09;
        padding-inline: 5%;
        padding-block: 15px;
        border-radius: 5px;
        font-weight: bold;
    }
    
    #carStatistics {
        display: flex;
        height: 100%;
        width: 100%;
        margin-block: 10px;
        flex-direction: column;
        gap: 10px;
    }
    
    #carStatistics > span:nth-child(1){
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
    
    #carStatistics > span:nth-child(1) > span {
        background-color: #316C40;
        border-radius: 5px;
        border: none;
        padding: 15px 20px;
        text-align: center;
    }
    
    #carStatistics > span:nth-child(1) > span > p:nth-child(1){
        opacity: 0.8;
    }
    
    #carStatistics > span:nth-child(1) > span > p:nth-child(2){
       font-size: 20px;
    }
    
    #carStatistics > span:nth-child(1) > span > button {
        outline: none;
        border: none;
        background-color: transparent;
        opacity: 0.6;
        color: #FDFFF6;
        font-size: 14px;
    }
    
    .recentCarActivity {
        background-color: #316C40;
        border-radius: 5px;
        overflow: scroll;
        padding: 0px 20px 15px 20px;
        height: 80%;
    }
    
    .recentCarActivity > p {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: 316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
    }
    
    .recentCarActivity > table{
        width: 100%;
        text-align: left;
        color: #FDFFF6;
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }
    
    .recentCarActivity th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 56px;
        background-color: #316C40;
    }
    
    .recentCarActivity tr:nth-child(even){
        background-color: #38814a;
    }
    
    .recentCarActivity tr:nth-child(odd) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }
    
    .recentCarActivityySearchBar {
        position: sticky;
        top: 88px;
        background-color: #316C40;
    }
    
    .recentCarActivityySearchBar td {
        border-bottom: 1px solid #E2F87B70;
        padding: 0px 0px;
    }
    
    .recentCarActivity td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        overflow-x: scroll;
    }
    
    .recentCarActivity input, .recentCarActivity select {
        width: 100%;
        outline: none;
        border: 1px solid #FDFFF6;
        background-color: #295234;
        padding: 0px 10px;
        height: 40px;
        border-radius: 5px;
        color: #FDFFF6;
    }
    
    .recentCarActivity > table input::-webkit-search-cancel-button {
        color: #FDFFF6;
        -webkit-appearance: none;
        appearance: none;
        height: 12px;
        width: 15px;
        position: relative;
        left: 7.5px;
        background-image: url("./images/icons/x-icon.svg");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .recentCarActivity > table input::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .recentCarActivity > table select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 2.5px;
    }
    
    .recentCarActivity > table select:nth-child(1){
        width: 70px;
    }

    #carStats td:nth-child(1){
        max-width: 70px;
        min-width: 70px;
    }

    #carStats td:nth-child(2), #carStats td:nth-child(3) {
        max-width: 85px;
        min-width: 85px;
    }

    #carStats td:nth-child(4), #carStats td:nth-child(5) {
        max-width: 150px;
        min-width: 150px;
    }

    #carStats td:nth-child(6) {
        max-width: 40px;
        min-width: 40px;
    }
    
    #carStats td:nth-child(7) {
        max-width: 40px;
        min-width: 40px;
    }

    #carStats td:nth-child(8) {
        max-width: 110px;
        min-width: 110px;
    }

    #recentFilterDate {
        width: 150px;
    }

    #recentFilterDmg {
        width: 100%;
    }

    #infoTemplateInfos > p {
        padding: 10px 5px;
    }

    #infoTemplateInfos > p:nth-child(even){
        background-color: #316C40;
    }

    .carMaintenancePanel > span > div > input::placeholder {
        color: #FDFFF680;
    }

    #carMaintenanceCard img {
        height: 123px;
        width: 185px;
    }

    #carMaintenanceCard p {
        width: 178px;
        overflow-x: scroll;
        text-wrap: nowrap;
        padding: 5px;
    }

    #carMaintenanceCard > span {
        border: 1px solid #FDFFF6;
        border-radius: 5px;
        overflow: hidden;
    }

    #carMaintenanceCard > span > span {
        display: flex;
        flex-direction: row;
        justify-content: left;
        padding: 0px 5px;
    }

    #carMaintenanceCard > span > span input, #carMaintenanceCard > span > span label {
        padding: 0px;
    }

    #carMaintenanceCard > span > button {
        width: 80%;
        background-color: #E2F87B;
        color: #031A09;
        padding: 2.5px;
        margin-block: 5px;
        border: none;
        border-radius: 5px;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
    
    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }
</style>