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
        .homePage {
            height: 100%;
            width: 100%;
            display: block;
        }
        .rentPage {
            display: none;
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
    <section class="homePageWrapper">
        <span class="loginUserConfirmationWrapper">
            <span class="loginUserConfirmationBG" onclick="toggleSignupAlert('hide')"></span>
            <span class="loginUserConfirmation" onclick="toggleSignupAlert('hide')">
                <button>&#215;</button>
                <p>Seems Like You Don't Have an Account</p>
                <a href="../auth/signup.php">Sign Me Up!</a>
                <a href="../auth/login.php">Log In!</a>
            </span>
        </span>
        <span id='catchDoubleBooking' style="height: 100%; width: 100%; display: none; place-items: center; position: fixed; z-index: 99; pointer-events: none;">
            <span onclick="document.getElementById('catchDoubleBooking').style.display = 'none';" style="height: 100%; width: 100%; position: absolute; z-index: 100; background-color: #031A0980; pointer-events: all;"></span>
            <span style="display: flex; flex-direction: column; align-items: center; background-color: #316C40; padding: 15px 20px; pointer-events: all; color: #FDFFF6; z-index: 101; border: 2px solid #E2F87B;">
                <button onclick="document.getElementById('catchDoubleBooking').style.display = 'none';" style="align-self: end; width: 0px; height: 10px; transform: translateY(-10px); background-color: transparent; outline: none; border: none; color: #E2F87B;">&#215;</button>
                <p>You already booked a car goblin!</p>
                <button onclick="setActiveBtn(2); document.getElementById('catchDoubleBooking').style.display = 'none';" style="background-color: #E2F87B; outline: none; border: none; padding: 5px 15px; color: #316C40; font-weight: bold; margin-top: 10px;">SEE MY BOOKING</button>
            </span>
        </span>
        <?php
            if(isset($_SESSION["email"])){
                if($_SESSION["role"] == "Customer"){
                    echo "<p class='notif'>Hello World!</p>";
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
                    echo "<div class='homePage'>";
                    include_once("./panels/customer/rentStatus.php");
                    include_once("./components/carSelection.php");
                    echo "<span class='carsDisplay'>";
                    include_once("./components/cars.php");
                    echo "</span>
                        </section>";
                    echo "</div>";

                    include_once("./panels/customer/customerBooking.php");
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
                echo "<div class='homePage'>
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
    </section>
    <section class="rentPage">
        <?php
            include("./pages/rent.php");
        ?>
    </section>
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

    // let overviewBtn, vehiclesBtn, bookingsBtn, usersBtn, ticketsBtn, logsBtn, adminNavIndicator;
    // let moreVehicleSettings, vehicleStatistics, vehicleManagement, userManagement;

    function setActiveBtn(index){
        homeBtn.classList.remove("active");
        aboutBtn.classList.remove("active");
        contactBtn.classList.remove("active");

        homePage.style.display = "none";
        aboutPage.style.display = "none";
        contactPage.style.display = "none";
        
        activeNav = index;
        if(document.getElementById("bookingBtn")){
            document.querySelector(".myBooking").style.display = "none";
            document.getElementById("bookingBtn").classList.remove("active");
            switch(index){
                case 1:
                    homeBtn.classList.add("active");
                    navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = homeBtn.clientWidth+8 +"px";
                    homePage.style.display = "block";
                    break;
                case 2:
                    document.getElementById("bookingBtn").classList.add("active");
                    navIndicator.style.left = document.getElementById("bookingBtn").offsetLeft-4 +"px";
                    navIndicator.style.width = document.getElementById("bookingBtn").clientWidth+8 +"px";
                    document.querySelector(".myBooking").style.display = "block";
                    break;
                case 3:
                    aboutBtn.classList.add("active");
                    navIndicator.style.left = aboutBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = aboutBtn.clientWidth+8 +"px";
                    aboutPage.style.display = "block";
                    break;
                case 4:
                    contactBtn.classList.add("active");
                    navIndicator.style.left = contactBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = contactBtn.clientWidth+8 +"px";
                    contactPage.style.display = "block";
                    
                    getMessages(document.getElementById("messages").className, "customer");
                    break;
            }
        }else{
            switch(index){
                case 1:
                    homeBtn.classList.add("active");
                    navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = homeBtn.clientWidth+8 +"px";
                    homePage.style.display = "block";   
                    break;
                case 2:
                    aboutBtn.classList.add("active");
                    navIndicator.style.left = aboutBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = aboutBtn.clientWidth+8 +"px";
                    aboutPage.style.display = "block";
                    break;
                case 3:
                    contactBtn.classList.add("active");
                    navIndicator.style.left = contactBtn.offsetLeft-4 +"px";
                    navIndicator.style.width = contactBtn.clientWidth+8 +"px";
                    contactPage.style.display = "block";
                    break;
            }
        }
    }

    function clearAllFilter(){
        document.getElementById("tFilter").value = "";
        document.getElementById("bFilter").value = "";
        document.getElementById("fuelFilter").value = "";
        document.getElementById("mFilter").value = "";
        
        getCars("", "", "", "", "", "");
    }

    // function setActiveBtnAdmin(index){
    //     overviewBtn.classList.remove("active");
    //     vehiclesBtn.classList.remove("active");
    //     bookingsBtn.classList.remove("active");
    //     usersBtn.classList.remove("active");
    //     ticketsBtn.classList.remove("active");
    //     logsBtn.classList.remove("active");

    //     moreVehicleSettings.classList.remove('open');
    //     vehicleStatistics.classList.remove("active");
    //     vehicleManagement.classList.remove("active");
    //     userManagement.classList.remove("active");

    //     switch(index){
    //         case 1:
    //             adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";
    //             overviewBtn.classList.add("active");
    //             adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
    //             break;
    //         case 2:
    //             moreVehicleSettings.classList.add('open');
    //             vehicleStatistics.classList.add("active");

    //             adminNavIndicator.style.top = vehiclesBtn.offsetTop-5 +"px";
    //             vehiclesBtn.classList.add("active");
    //             adminNavIndicator.style.width = vehiclesBtn.offsetWidth+20 +"px";
    //             break;
    //         case 3:
    //             adminNavIndicator.style.top = bookingsBtn.offsetTop-5 +"px";
    //             bookingsBtn.classList.add("active");
    //             adminNavIndicator.style.width = bookingsBtn.offsetWidth+20 +"px";
    //             break;
    //         case 4:
    //             userManagement.classList.add("active");
                
    //             adminNavIndicator.style.top = usersBtn.offsetTop-5 +"px";
    //             usersBtn.classList.add("active");
    //             adminNavIndicator.style.width = usersBtn.offsetWidth+20 +"px";
    //             break;
    //         case 5:
    //             adminNavIndicator.style.top = ticketsBtn.offsetTop-5 +"px";
    //             ticketsBtn.classList.add("active");
    //             adminNavIndicator.style.width = ticketsBtn.offsetWidth+20 +"px";
    //             break;
    //         case 6:
    //             adminNavIndicator.style.top = logsBtn.offsetTop-5 +"px";
    //             logsBtn.classList.add("active");
    //             adminNavIndicator.style.width = logsBtn.offsetWidth+20 +"px";
    //             break;
    //     }
    // }

    // function setActiveAdminSettings(name){
    //     vehicleStatistics.classList.remove("active");
    //     vehicleManagement.classList.remove("active");

    //     switch(name){
    //         case "vehicleStatistics":
    //             vehicleStatistics.classList.add("active");
    //             break;
    //         case "vehicleManagement":
    //             vehicleManagement.classList.add("active");
    //             break;
    //     }
    // }

    // function setActiveManagementPane(name){
    //     const popoverCover = document.querySelector(".popOverCover"); popoverCover.style.display = "block";
    //     const popover = document.querySelector(".popOver"); popover.style.display = "grid";
    //     const addCars = document.getElementById("addCars"); addCars.style.display = "none";
    //     const addBrands = document.getElementById("addBrands"); addBrands.style.display = "none";
    //     const addLocations = document.getElementById("addLocations"); addLocations.style.display = "none";
    //     const editPane = document.getElementById("editPane"); editPane.style.display = "none";
    //     const editPaneLocation = document.getElementById("editPaneLocation"); editPaneLocation.style.display = "none";
    //     const deleteConfirmation = document.getElementById("deleteConfirmation"); deleteConfirmation.style.display = "none";
        
    //     document.querySelector(".addBrandErrorMsg").innerHTML = "";
    //     document.querySelector(".addLocationErrorMsg").innerHTML = "";
    //     document.querySelector(".addCarErrorMsg").innerHTML = "Accepted Image Ratio is 3:2";

    //     document.getElementById("selectedBrand").setAttribute("value", "None");
    //     document.getElementById("selectedBrand").innerHTML = "";

    //     switch(name){
    //         case "addCars":
    //             document.querySelector(".addCarHeader").innerHTML = "New Vehicle";
    //             addCars.style.display = "block";
    //             break;
    //         case "brands":
    //         case "addBrands":
    //             addBrands.style.display = "block";
    //             break;
    //         case "locations":
    //         case "addLocations":
    //             addLocations.style.display = "block";
    //             break;
    //         case "editPane":
    //             editPane.style.display = "block";
    //             break;
    //         case "editPaneLocation":
    //             editPaneLocation.style.display = "block";
    //             break;
    //         case "deleteConfirmation":
    //             deleteConfirmation.style.display = "block";
    //             break;
    //         default:
    //             popoverCover.style.display = "none";
    //             popover.style.display = "none";

    //     }
    // }

    let carImage = false;
    function submitAddCar(event){
        const model = document.getElementById("model").value;
        const brand = document.getElementById("brand").value;
        const transmission = document.getElementById("transmission").value;
        const fueltype = document.getElementById("fueltype").value;
        const location = document.getElementById("location").value;
        const availability = document.getElementById("availability").value;
        let priceDay = document.getElementById("priceDay").value;
        priceDay = priceDay.slice(1, priceDay.length);

        if(model.trim() == "" || brand == "None" || transmission == "None" ||  fueltype == "None" || location == "None" || availability == "None" || priceDay == ""){
            document.querySelector(".addCarErrorMsg").innerHTML = "<p>Fill All Fields</p>";
            event.preventDefault();
        }else if(!carImage){
            document.querySelector(".addCarErrorMsg").innerHTML = "<p>Image Is Invalid!</p>";
            event.preventDefault();
        }else if(priceDay.includes(".")){
            if(!/^[0-9]+\.+[0-9]{2}$/.test(priceDay)){
                document.querySelector(".addCarErrorMsg").innerHTML = "<p>Price Is Invalid!</p>";
                event.preventDefault();
            }
            if(priceDay.slice(0, priceDay.length-3).length > 5){
                document.querySelector(".addCarErrorMsg").innerHTML = "<p>Price is Too High!</p>";
                event.preventDefault();
            }
        }else if(!priceDay.includes(".")){
            if(priceDay.includes(".")){
                document.querySelector(".addCarErrorMsg").innerHTML = "<p>Price is Too High!</p>";
                event.preventDefault();
            }
            if(/[^0-9]/.test(priceDay)){
            document.querySelector(".addCarErrorMsg").innerHTML = "<p>Price is Invalid!</p>";
            event.preventDefault();
            }
        }
    }

    function editCar(id, imagePath, brand, model, pricePerDay, transmission, fueltype, availability){
        const popoverCover = document.querySelector(".popOverCover"); popoverCover.style.display = "block";
        const popover = document.querySelector(".popOver"); popover.style.display = "grid";
        
        const tempCarImg = document.getElementById('tempCarImg');
        const tempCarImgContext = tempCarImg.getContext('2d');
        const currentCarImg = new Image();
        currentCarImg.src = './images/cars/' +imagePath;
        currentCarImg.onload = async () => {
            tempCarImgContext.drawImage(currentCarImg, 0, 0, 300, 150);
            tempCarImg.toBlob((blob) => {
                const url = URL.createObjectURL(blob);
                console.log(blob)
                document.querySelector(".carImg").src = url;
            });
        };
 
        document.querySelector(".addCarHeader").innerHTML = "Edit Vehicle";
        const newModel = document.getElementById("model"); newModel.value = model; 
        const newBrand = document.getElementById("brand");
        const newTransmission = document.getElementById("transmission"); 
        const newFueltype = document.getElementById("fueltype"); 
        const newLocation = document.getElementById("location"); 
        const newAvailability = document.getElementById("availability"); 
        const newPriceDay = document.getElementById("priceDay"); 
        const newCarImgInput = document.getElementById("carImgInput");
        
        // console.log(URL.createObjectURL("./images/cars"+imagePath));
        document.getElementById(brand).setAttribute("selected", true);
        document.getElementById(location).setAttribute("selected", true);
        // document.getElementById("selectedLocation").setAttribute("value", clocation);
        // document.getElementById("selectedLocation").innerHTML = clocation;
        // document.getElementById("selectedTransmission").setAttribute("value", ctransmission);
        // document.getElementById("selectedTransmission").innerHTML = ctransmission;
        // document.getElementById("selectedFuelType").setAttribute("value", cfueltype);
        // document.getElementById("selectedFuelType").innerHTML = cfueltype;

        const editCar = document.getElementById("addCars"); addCars.style.display = "block";
    }

    let imgFakePath = "";
    window.onload = () => {
        if(document.querySelector(".guestBG")){
            document.querySelector(".carsWrapper").addEventListener("mouseenter", ()=>{ window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth'}) });
            document.querySelector(".scrollCars").addEventListener("scroll", ()=>{ window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth'}) });
            document.querySelector(".guestBG").addEventListener("mouseenter", ()=>{ window.scrollTo({ top: 0, behavior: 'smooth' }) });
            navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
            navIndicator.style.width = homeBtn.clientWidth+8 +"px";
        }

        
        // if(document.querySelector(".adminNav")){
        //     overviewBtn = document.getElementById('overviewBtn');
        //     vehiclesBtn = document.getElementById('vehiclesBtn');
        //     bookingsBtn = document.getElementById('bookingsBtn');
        //     usersBtn = document.getElementById('usersBtn');
        //     ticketsBtn = document.getElementById('ticketsBtn');
        //     logsBtn = document.getElementById('logsBtn');
        //     adminNavIndicator = document.querySelector('.adminNavIndicator');

        //     moreVehicleSettings = document.querySelector('.moreVehicleSettings');
        //     vehicleStatistics = document.querySelector('.vehicleStatistics');
        //     vehicleManagement = document.querySelector('.vehicleManagement');
        //     userManagement = document.querySelector('.userManagement');

        //     adminNavIndicator.style.height = overviewBtn.offsetHeight+10 +"px";
        //     adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
        //     adminNavIndicator.style.left = overviewBtn.offsetLeft-5 +"px";
        //     adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";
        // }

        if(document.getElementById("priceDay")){
            document.getElementById("priceDay").oninput = (event) => { document.getElementById("priceDay").value.length == 0 ? document.getElementById("priceDay").value = "₱" : "" }
        }

        if(document.getElementById("carImgInput")){
            let urlBlob;
            document.getElementById("carImgInput").addEventListener('change', (e) => {
                console.log(document.getElementById("carImgInput").value)
                try{
                    urlBlob = URL.createObjectURL(e.target.files[0]);
                    imgFakePath = document.getElementById("carImgInput").value;
                }catch(error){
                }finally{
                    document.querySelector(".carImg").src = urlBlob;
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
                }
                console.log(urlBlob)
            });
        }
    }

    window.onresize = () => {
        if(document.querySelector(".guestBG")) setActiveBtn(activeNav);
        if(document.querySelector(".adminNav")) { adminNavIndicator.style.left = overviewBtn.offsetLeft-5 +"px"; if(activeAdminNav == 1){adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";}else if(activeAdminNav == 2){adminNavIndicator.style.top = vehiclesBtn.offsetTop-5 +"px";}else if(activeAdminNav == 3){adminNavIndicator.style.top = bookingsBtn.offsetTop-5 +"px";}else if(activeAdminNav == 4){adminNavIndicator.style.top = usersBtn.offsetTop-5 +"px";}else if(activeAdminNav == 5){adminNavIndicator.style.top = paymentsBtn.offsetTop-5 +"px";}else if(activeAdminNav == 6){adminNavIndicator.style.top = vouchersBtn.offsetTop-5 +"px";}else if(activeAdminNav == 7){adminNavIndicator.style.top = ticketsBtn.offsetTop-5 +"px";}else if(activeAdminNav == 8){adminNavIndicator.style.top = logsBtn.offsetTop-5 +"px";} }
    }
</script>
<script type="text/javascript">
    async function checkCarAvailability(carID) {
        let result;
        await $.ajax({
            type: 'post',
            url: './queries/car/checkCarAvailability.php',
            data: { carID: carID },
            success: function(res){
                result = res;
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });
        return result;
    }

    async function submitRent(carId, pickUpLocation, dropOffLocation, startDateTime, endDateTime, paymentMethod, paymentFrequency, amountPaid, voucher, userID){
        await $.ajax({
            type: 'post',
            url: './queries/rent/addRent.php',
            data: { carID: carId, pickUpLocation: pickUpLocation, dropOffLocation: dropOffLocation, startDateTime: startDateTime, endDateTime: endDateTime, paymentMethod: paymentMethod, paymentFrequency: paymentFrequency, amountPaid: amountPaid, voucher: voucher, userID: userID },
            success: function(res){
                if(!res.includes("Error")){
                    $(".notif").html("<span class='success'>Car Booked</span>");
                    document.querySelector(".homePageWrapper").style.display = "block";
                    document.querySelector(".rentPage").style.display = "none";
                }else{
                    $(".notif").html("<span class='error'>Something Went Wrong</span>");
                }
            },
            error: function(){
                $(".msg").html("Error Pre");
            }
        });

        getCars("", "", "", "", "", "");
    }

    async function addCars(){
        
    }

    async function getCars(transmission, brand, fuelType, model, sort, order) {
        $.ajax({
            type: 'post',
            url: './queries/car/getCars.php',
            data: { type: 'getCars', from: 'customer', transmission: transmission,  brand: brand, fuelType: fuelType, model: model, sortBy: sort, orderBy: order },
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
        const defaultOption = "<option value='None' id='selectedBrand' selected disabled></option>";
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
        const newAddressCode = document.getElementById("newAddressCode").value;
        const newDistance = document.getElementById("newDistance").value;
        
        if(newLocation.trim() == "" || newAddressCode.trim() == "" || newDistance.trim() == ""){
            document.querySelector(".addLocationErrorMsg").innerHTML = "<p>Fields Cannot Be Empty!</p>";
            return;
        }else{
            document.querySelector(".addLocationErrorMsg").innerHTML = "";
        }

        await $.ajax({
            type: "post",
            url: "./queries/location/addLocation.php",
            data: { location: newLocation, address: newAddressCode, distance: newDistance },
            success: function(res){
                $(".msg").html(res);
                if(!res.includes("error")){
                    $("#newLocation").val("");
                    $("#newAddressCode").val("");
                    $("#newDistance").val("");
                }
            },
            error: function(err){
                $(".msg").html("Error Pre");
            }
        });

        getLocations();
    }

    async function getLocations(){
        // const defaultOption = "<option value='None' id='selectedLocation' selected disabled></option>";
        // await $.ajax({
        //     type: "get",
        //     url: "./queries/location/getLocations.php",
        //     success: function(res){
        //         $("#location").html(defaultOption + res);
        //     },
        //     error: function(err){
        //         $(".msg").html("Error Pre");
        //     }
        // });

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

    async function getLocationsForRent(){
        await $.ajax({
            type: 'get',
            url: "./queries/location/getLocations.php",
            success: function(res){
                $("#pickUpLocation").html(res);
                $("#dropOffLocation").html(res);
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
        getCars("", "", "", "", "", );
    });

    // async function submitRent(carId, pickUpLocation, dropOffLocation, startDateTime, endDateTime, paymentMethod, amountPaid, voucher, UID){
    //     await $.ajax({
    //         type: 'post',
    //         url: './queries/rent/addRent.php',
    //         data: { action: "updateCar", carID: carId },
    //         success: function(res){
    //             console.log("UpdateCar: " +res)
    //         },
    //         error: function(){
    //             $(".msg").html("Error Pre");
    //         }
    //     });

    //     await $.ajax({
    //         type: 'post',
    //         url: './queries/rent/addRent.php',
    //         data: { action: "addRental", carID: carId, pickUpLocation: pickUpLocation, dropOffLocation: dropOffLocation, startDateTime: startDateTime, endDateTime: endDateTime, UID: UID },
    //         success: function(res){
    //             console.log("AddRental: " +res)
    //         },
    //         error: function(){
    //             $(".msg").html("Error Pre");
    //         }
    //     });

    //     let rentalID;
    //     await $.ajax({
    //         type: 'post',
    //         url: './queries/rent/addRent.php',
    //         data: { action: "getRentalID", UID: UID },
    //         success: function(res){
    //             rentalID = res;
    //             console.log("GetRentalID: " +res)
    //         },
    //         error: function(){
    //             $(".msg").html("Error Pre");
    //         }
    //     });

    //     $.ajax({
    //         type: 'post',
    //         url: './queries/rent/addRent.php',
    //         data: { action: "addPayment", rentalID: rentalID, paymentMethod: paymentMethod, amountPaid: amountPaid, voucher: voucher },
    //         success: function(res){
    //             console.log("AddPayment: " +res)
    //             $(".msg").html("Car Booked");
    //         },
    //         error: function(){
    //             $(".msg").html("Error Pre");
    //         }
    //     });
    // }
</script>
<script type="text/javascript">
    async function toggleRentPage(carID, brandName, modelName, rentalPrice, transmission, fuelType, imgUrl){
        await $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getCar' },
            success: async function(res) {
                if(res == "No Car Rent"){
                    await getLocationsForRent();
                    setInitialRentInfo(carID, brandName, modelName, rentalPrice, transmission, fuelType, "./images/cars/" + imgUrl);

                    document.querySelector(".homePageWrapper").style.display = "none";
                    document.querySelector(".rentPage").style.display = "block";
                }else{
                    document.getElementById('catchDoubleBooking').style.display = 'grid';
                }
            },
            error: function(error) {}
        });
    }
</script>
</html>
