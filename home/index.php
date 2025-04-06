<?php
  session_start();
  require("../database/db_conn.php");

  include_once("./style.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./vendor/jquery-3.7.1.min.js"></script>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        .loginUserConfirmationWrapper, .loginUserConfirmationBG {
            position: fixed;
            top: 0px;
            left: 0px;
            height: 100vh;
            width: 100vw;
            display: none;
            place-items: center;
            z-index: 999;
        }
        .loginUserConfirmationBG {
            background-color: #031A0980;
            display: block;
        }
        .loginUserConfirmation {
            background-color: #38814a;
            color: #FDFFF6;
            z-index: 1000;
        }
    </style>
    <script type="text/javascript">
        function toggleSignupAlert(state){
            if(state == "hide"){
                document.querySelector(".loginUserConfirmationWrapper").style.display = "none";
            }else{
                document.querySelector(".loginUserConfirmationWrapper").style.display = "grid";
            }
        }
    </script>
    <title>Car Rental</title>
</head>
<body>
    <span class="loginUserConfirmationWrapper">
        <span class="loginUserConfirmationBG" onclick="toggleSignupAlert('hide')"></span>
        <span class="loginUserConfirmation" onclick="toggleSignupAlert('hide')">
            <button>&#215;</button>
            <p>Seems Like You Don't Have an Account</p>
            <a href="../auth/signup.php">Sign Me Up!</a>
        </span>
    </span>
    <?php
        if(isset($_SESSION["email"])){
            if($_SESSION["role"] == "Customer"){
                echo "<span class='navIndicator'></span>";
                echo "<nav>
                        <span>
                            <h3>Quick Ride</h3>
                            <button onclick='setActiveBtn(1)' id='homeBtn' class='active'>Home</button>
                            <button onclick='setActiveBtn(2)' id='bookingBtn'>My Bookings</button>
                            <button onclick='setActiveBtn(3)' id='aboutBtn'>About</button>
                            <button onclick='setActiveBtn(4)' id='contactBtn'>Contact</button>
                        </span>
                        <span class='logout'>
                            <a href='../auth/logout.php'>logout</a>
                        </span>
                    </nav>";
                echo "<div class='homePage active'>";
                include_once("./panels/customer/customer.php");
                include_once("./components/carSelection.php");
                echo "<span class='carsDisplay'>";
                include_once("./components/cars.php");
                echo "</span>
                    </section>";
                echo "</div>";

                include_once("./panels/customer/aboutUs.php");
                include_once("./panels/customer/contactUs.php");
            }
        }else{
            echo "<span class='navIndicator'></span>";
            echo "<nav>
                    <span>
                        <h3>Quick Ride</h3>
                        <button onclick='setActiveBtn(1)' id='homeBtn' class='active'>Home</button>
                        <button onclick='setActiveBtn(2)' id='aboutBtn'>About</button>
                        <button onclick='setActiveBtn(3)' id='contactBtn'>Contact</button>
                    </span>
                    <span class='authGuest'>
                        <a href='../auth/login.php'>Log In</a>
                        <a href='../auth/signup.php'>Sign Up</a>
                    </span>
                </nav>";
            echo "<div class='homePage active'>
                    <div class='guestBG'>
                        <span>
                            <p>Fast & Affordable</p>
                        </span>
                    </div>";
            include_once("./components/carSelection.php");
            echo "<span class='carsDisplay'>";
            include_once("./components/cars.php");
            echo " </span>
                </section>
                </div>";

            include_once("./panels/customer/aboutUs.php");
            include_once("./panels/customer/contactUs.php");
        }

        if(isset($_SESSION["email"])){
            if($_SESSION["role"] == "Admin"){
                include_once("./panels/admin/admin.php");
            }
        }
    ?>
</body>
<script type="text/javascript">
    const homeBtn = document.getElementById("homeBtn");
    const aboutBtn = document.getElementById("aboutBtn");
    const contactBtn = document.getElementById("contactBtn");
    const navIndicator = document.querySelector(".navIndicator");
    const guestBg = document.querySelector(".guestBG");
    let activeNav = 1;

    const homePage = document.querySelector(".homePage");
    const aboutPage = document.querySelector(".aboutPage");
    const contactPage = document.querySelector(".contactPage");

    let overviewBtn, vehiclesBtn, bookingsBtn, usersBtn, ticketsBtn, logsBtn, adminNavIndicator;
    let moreVehicleSettings, vehicleStatistics, vehicleManagement;

    function setActiveBtn(index){
        homeBtn.classList.remove("active");
        aboutBtn.classList.remove("active");
        contactBtn.classList.remove("active");
        homePage.classList.remove("active");
        aboutBtn.classList.remove("active");
        contactBtn.classList.remove("active");

        activeNav = index;
        if(document.getElementById("bookingBtn")){
            document.getElementById("bookingBtn").classList.remove("active");
            switch(index){
                case 1:
                    homeBtn.classList.add("active");
                    navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = homeBtn.clientWidth+8 +"px";
                    homePage.classList.add("active");
                    break;
                case 2:
                    document.getElementById("bookingBtn").classList.add("active");
                    navIndicator.style.left = document.getElementById("bookingBtn").offsetLeft-4 +"px";
                    navIndicator.style.width = document.getElementById("bookingBtn").clientWidth+8 +"px";
                    document.getElementById("myBooking").classList.add("active");
                    break;
                case 3:
                    aboutBtn.classList.add("active");
                    navIndicator.style.left = aboutBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = aboutBtn.clientWidth+8 +"px";
                    aboutBtn.classList.add("active");
                    break;
                case 4:
                    contactBtn.classList.add("active");
                    navIndicator.style.left = contactBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = contactBtn.clientWidth+8 +"px";
                    contactBtn.classList.add("active");
                    break;
            }
        }else{
            switch(index){
                case 1:
                    homeBtn.classList.add("active");
                    navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = homeBtn.clientWidth+8 +"px";
                    homePage.classList.add("active");
                    break;
                case 2:
                    aboutBtn.classList.add("active");
                    navIndicator.style.left = aboutBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = aboutBtn.clientWidth+8 +"px";
                    aboutBtn.classList.add("active");
                    break;
                case 3:
                    contactBtn.classList.add("active");
                    navIndicator.style.left = contactBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = contactBtn.clientWidth+8 +"px";
                    contactBtn.classList.add("active");
                    break;
            }
        }
    }

    function clearAllFilter(){
        document.getElementById("tFilter").value = "";
        document.getElementById("bFilter").value = "";
        document.getElementById("fuelFilter").value = "";
        document.getElementById("mFilter").value = "";
    }

    function setActiveBtnAdmin(index){
        overviewBtn.classList.remove("active");
        vehiclesBtn.classList.remove("active");
        bookingsBtn.classList.remove("active");
        usersBtn.classList.remove("active");
        ticketsBtn.classList.remove("active");
        logsBtn.classList.remove("active");

        moreVehicleSettings.classList.remove('open');
        vehicleStatistics.classList.remove("active");

        switch(index){
            case 1:
                adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";
                overviewBtn.classList.add("active");
                adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
                break;
            case 2:
                moreVehicleSettings.classList.add('open');
                vehicleStatistics.classList.add("active");

                adminNavIndicator.style.top = vehiclesBtn.offsetTop-5 +"px";
                vehiclesBtn.classList.add("active");
                adminNavIndicator.style.width = vehiclesBtn.offsetWidth+20 +"px";
                break;
            case 3:
                adminNavIndicator.style.top = bookingsBtn.offsetTop-5 +"px";
                bookingsBtn.classList.add("active");
                adminNavIndicator.style.width = bookingsBtn.offsetWidth+20 +"px";
                break;
            case 4:
                adminNavIndicator.style.top = usersBtn.offsetTop-5 +"px";
                usersBtn.classList.add("active");
                adminNavIndicator.style.width = usersBtn.offsetWidth+20 +"px";
                break;
            case 5:
                adminNavIndicator.style.top = ticketsBtn.offsetTop-5 +"px";
                ticketsBtn.classList.add("active");
                adminNavIndicator.style.width = ticketsBtn.offsetWidth+20 +"px";
                break;
            case 6:
                adminNavIndicator.style.top = logsBtn.offsetTop-5 +"px";
                logsBtn.classList.add("active");
                adminNavIndicator.style.width = logsBtn.offsetWidth+20 +"px";
                break;
        }
    }

    function setActiveAdminSettings(name){
        vehicleStatistics.classList.remove("active");
        vehicleManagement.classList.remove("active");

        switch(name){
            case "vehicleStatistics":
                vehicleStatistics.classList.add("active");
                break;
            case "vehicleManagement":
                vehicleManagement.classList.add("active");
                break;
        }
    }

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

        switch(name){
            case "addCars":
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

    let carImage = false;
    function submitAddCar(event){
        const model = document.getElementById("model").value;
        const brand = document.getElementById("brand").value;
        const transmission = document.getElementById("transmission").value;
        const fueltype = document.getElementById("fueltype").value;
        const location = document.getElementById("location").value;
        const availability = document.getElementById("availability").value;
        const priceDay = document.getElementById("priceDay").value;

        if(model.trim() == "" || brand.trim() == "" || transmission.trim() == "" ||  fueltype.trim() == "" || location.trim() == "" || availability.trim() == "" || priceDay.trim() == "₱"){
            document.querySelector(".addCarErrorMsg").innerHTML = "<p>Fill All Fields</p>";
            event.preventDefault();
        }else if(carImage == false){
            document.querySelector(".addCarErrorMsg").innerHTML = "<p>Image Is Invalid!</p>";
            event.preventDefault();
        }
    }

    function editCar(brand, model, fueltype, price, location, availability, pricePerDay){
        
    }

    window.onload = () => {
        if(document.querySelector(".guestBG")){
            document.querySelector(".carsWrapper").addEventListener("mouseenter", ()=>{ window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth'}) });
            document.querySelector(".scrollCars").addEventListener("scroll", ()=>{ window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth'}) });
            document.querySelector(".guestBG").addEventListener("mouseenter", ()=>{ window.scrollTo({ top: 0, behavior: 'smooth' }) });
            navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
            navIndicator.style.width = homeBtn.clientWidth+8 +"px";
        }

        
        if(document.querySelector(".adminNav")){
            overviewBtn = document.getElementById('overviewBtn');
            vehiclesBtn = document.getElementById('vehiclesBtn');
            bookingsBtn = document.getElementById('bookingsBtn');
            usersBtn = document.getElementById('usersBtn');
            ticketsBtn = document.getElementById('ticketsBtn');
            logsBtn = document.getElementById('logsBtn');
            adminNavIndicator = document.querySelector('.adminNavIndicator');

            moreVehicleSettings = document.querySelector('.moreVehicleSettings');
            vehicleStatistics = document.querySelector('.vehicleStatistics');
            vehicleManagement = document.querySelector('.vehicleManagement');

            adminNavIndicator.style.height = overviewBtn.offsetHeight+10 +"px";
            adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
            adminNavIndicator.style.left = overviewBtn.offsetLeft-5 +"px";
            adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";
        }

        if(document.getElementById("priceDay")){
            document.getElementById("priceDay").oninput = (event) => { document.getElementById("priceDay").value.length == 0 ? document.getElementById("priceDay").value = "₱" : "" }
        }

        if(document.getElementById("carImgInput")){
            document.getElementById("carImgInput").addEventListener('change', (e) => {
                document.querySelector(".carImg").src = URL.createObjectURL(e.target.files[0]);
                document.querySelector(".carImg").onload = function(){
                    const width = this.naturalWidth; //53.5
                    const height = this.naturalHeight;

                    const ratio = (width/height).toFixed(1);

                    if(ratio != 1.5){
                        carImage = false;
                        document.querySelector(".addCarErrorMsg").innerHTML = "Image Doesn't Meet The Expected Aspect Ratio 3:2";
                    }else{
                        document.querySelector(".addCarErrorMsg").innerHTML = "";
                        carImage = true;
                    }
                }
            });
        }
    }

    window.onresize = () => {
        if(document.querySelector(".guestBG")) setActiveBtn(activeNav);
        if(document.querySelector(".adminNav")) { adminNavIndicator.style.left = overviewBtn.offsetLeft-5 +"px";  adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px"; }
    }
</script>
<script type="text/javascript">
    async function addVehicle(){
        
    }

    async function getCars() {
        $.ajax({
            type: 'post',
            url: './queries/car/getCars.php',
            data: {},
            success: function(res){
                $(".scrollCars").html(res);
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });
    }

    async function addBrand(){
        const newBrand = document.getElementById("newBrand").value;

        if(newBrand.trim() == "") {
            document.querySelector(".addBrandErrorMsg").innerHTML = "<p>Brand Cannot Be Empty!</p>";
            return;
        }else{
            document.querySelector(".addBrandErrorMsg").innerHTML = "";
        }

        await $.ajax({
            type: "post",
            url: "./queries/brand/addBrand.php",
            data: { brand: newBrand },
            success: function(res){
                $(".msg").html(res);
                if(!res.includes("error")){
                    $("#newBrand").val("");
                }
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });

        getBrands();
    }

    function getBrands(){
        const defaultOption = "<option value='None' selected disabled></option>";
        $.ajax({
            type: "get",
            url: "./queries/brand/getBrands.php",
            success: function(res){
                $("#brand").html(defaultOption + res);
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });


        $.ajax({
            type: "get",
            url: "./queries/brand/getBrandsList.php",
            success: function(res){
                $(".brandsList").html(res);
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });
    }

    async function editBrands(brandID, brandName){
        $("#editBrandField").val("");
        if(document.getElementById("editMsg").innerHTML.slice(2, document.getElementById("editMsg").innerHTML.length - 2) == brandName){
            $(".msg").html("<p class='error'>Brand Already Exist</p>");
            return;
        }

        await $.ajax({
            type: "post",
            url: "./queries/brand/editBrand.php",
            data: { brandID: brandID, newBrand: brandName },
            success: function(res){
                $(".msg").html(res);
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });
        
        getBrands();
    }

    async function deleteBrands(brandID){
        await $.ajax({
            type: "post",
            url: "./queries/brand/deleteBrand.php",
            data: { id: brandID },
            success: function(res){
                $(".msg").html(res);
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });

        getBrands();
    }

    async function addLocation(){
        const newLocation = document.getElementById("newLocation").value;
        
        if(newLocation.trim() == ""){
            document.querySelector(".addLocationErrorMsg").innerHTML = "<p>Location Cannot Be Empty!</p>";
            return;
        }else{
            document.querySelector(".addLocationErrorMsg").innerHTML = "";
        }

        await $.ajax({
            type: "post",
            url: "./queries/location/addLocation.php",
            data: { address: newLocation },
            success: function(res){
                $(".msg").html(res);
                if(!res.includes("error")){
                    $("#newLocation").val("");
                }
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });

        getLocations();
    }

    async function getLocations(){
        const defaultOption = "<option value='None' selected disabled></option>";
        await $.ajax({
            type: "get",
            url: "./queries/location/getLocations.php",
            success: function(res){
                $("#location").html(defaultOption + res);
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });

        await $.ajax({
            type: "get",
            url: "./queries/location/getLocationsList.php",
            success: function(res){
                $(".locationsList").html(res);
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });
    }

    async function editLocation(newAddress, locationID){
        $("#editLocationField").val("");
        if(document.getElementById("editLocationName").innerHTML.slice(2, document.getElementById("editLocationName").innerHTML.length - 2) == newAddress){
            $(".msg").html("<p class='error'>Location Already Exist</p>");
            return;
        }

        await $.ajax({
            type: "post",
            url: "./queries/location/editLocation.php",
            data: { address: newAddress, id: locationID },
            success: function(res){
                $(".msg").html(res);
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });
        
        getLocations();
    }

    async function deleteLocations(locationID){
        await $.ajax({
            type: "post",
            url: "./queries/location/deleteLocation.php",
            data: { id: locationID },
            success: function(res){
                $(".msg").html(res);
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });

        getLocations();
    }

    function editPane(name, id){
        document.getElementById("editMsg").innerHTML = `[ ${name} ]`;
        document.querySelector(".submitEditPane").title = id;
    }

    function editAction(id, action){
        if(action == "edit"){
            if($("#editBrandField").val().trim() == "") {
                document.querySelector(".addBrandErrorMsg").innerHTML = "<p>Brand Cannot Be Empty!</p>";
                return;
            }
            document.querySelector(".addBrandErrorMsg").innerHTML = "";
            editBrands(id, $("#editBrandField").val());
        }
    }

    function editLocationF(name, id){
        document.getElementById("editLocationName").innerHTML = `[ ${name} ]`;
        document.querySelector(".submitEditPaneLocation").title = id;
    }

    function editActionLocation(id, type){
        const newLocation = document.getElementById("editLocationField").value;
        if(type == "edit"){
            if(newLocation.trim() == ""){
                document.querySelector(".addLocationErrorMsg").innerHTML = "<p>Location Cannot Be Empty!</p>";
                return;
            }else{
                editLocation(newLocation, id);
            }
        }
    }

    function deleteConfirmation(type, name, id){
        document.getElementById("deleteName").innerHTML = `[ ${name} ]`;
        document.querySelector(".confirmDelete").title = id;

        switch(type){
            case "brands":
                document.getElementById("deleteMsg").innerHTML = "Are you sure to delete this brand?";
                
                document.querySelector(".exitConfirmation").id = "brands";
                document.querySelector(".confirmDelete").id = "brands";
                break;
            case "locations":
                document.getElementById("deleteMsg").innerHTML = "Are you sure to delete this Location?";

                document.querySelector(".exitConfirmation").id = "locations";
                document.querySelector(".confirmDelete").id = "locations";
                break;
        }
    }

    function deleteAction(...data){
        switch(data[1]){
            case "brands":
                if(data[0] == "delete") deleteBrands(data[2]);
                break;
            case "locations":
                if(data[0] == "delete") deleteLocations(data[2]);
                break;
        }
    }

    $(document).ready(function(){
        getBrands();
        getLocations();
        getCars();
    });
</script>
</html>
