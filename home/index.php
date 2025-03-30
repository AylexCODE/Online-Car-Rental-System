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
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Car Rental</title>
</head>
<body>
<?php
    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Customer"){
            echo "<span class='navIndicator'></span>";
            echo "<nav>
                    <span>
                        <h3>Quick Ride</h3>
                        <button onclick='setActiveBtn(1)' id='homeBtn' class='active'>Home</button>
                        <button onclick='setActiveBtn(2)' id='aboutBtn'>About</button>
                        <button onclick='setActiveBtn(3)' id='contactBtn'>Contact</button>
                    </span>
                    <span>
                        <a href='../auth/logout.php'>logout</a>
                    </span>
                </nav>";
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
        echo "<div class='homeWrapper'>
                <div class='guestBG'>
                    <span>
                        <p>Fast & Affordable</p>
                    </span>
                </div>";
        echo "<section class='carsWrapper'>
                <span class='carFilter'>
                    <span>
                        <p>Filter by</p>
                        <input list='transmissionFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Transmission'>
                        <datalist id='transmissionFilter'>
                            <option>Manual</option>
                            <option>Auto</option>
                        </datalist>
                        <input list='brandsFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Brands'>
                        <datalist id='brandsFilter'>
                            <option>Toyota</option>
                            <option>Ferrari</option>
                        </datalist>
                        <input list='fuelTypeFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Fuel Type'>
                        <datalist id='fuelTypeFilter'>
                            <option>Petrolium</option>
                            <option>Diesel</option>
                        </datalist>
                        <input list='modelFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Model'>
                        <datalist id='modelFilter'>
                            <option>GTR 40</option>
                            <option>Ford</option>
                        </datalist>
                        <button>Clear All Filter</button>
                    </span>
                    <span>
                        <p>Sort by</p>
                        <select>
                            <option>Alphabet</option>
                            <option>Newest</option>
                            <option>Oldest</option>
                    </span>
                </span>
                <span class='carsDisplay'>";
        include_once("./components/cars.php");
        echo " </span>
            </section>";

        echo "</div>";
    }

    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Admin"){
            include_once("./panels/admin.php");
        }else{
            include_once("./panels/customer.php");
        }
    }else{

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

    function setActiveBtn(index){
        homeBtn.classList.remove("active");
        aboutBtn.classList.remove("active");
        contactBtn.classList.remove("active");

        activeNav = index;
        switch(index){
            case 1:
                homeBtn.classList.add("active");
                navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
                navIndicator.style.width = homeBtn.clientWidth+8 +"px";
                break;
            case 2:
                aboutBtn.classList.add("active");
                navIndicator.style.left = aboutBtn.offsetLeft-4 +"px";
                navIndicator.style.width = aboutBtn.clientWidth+8 +"px";
                break;
            case 3:
                contactBtn.classList.add("active");
                navIndicator.style.left = contactBtn.offsetLeft-4 +"px";
                navIndicator.style.width = contactBtn.clientWidth+8 +"px";
                break;
        }
    }

    window.onload = () => {
        navIndicator.style.left = homeBtn.offsetLeft-4 +"px";
        navIndicator.style.width = homeBtn.clientWidth+8 +"px";
    }

    window.onresize = () => {
        setActiveBtn(activeNav);
    }
</script>
</html>
