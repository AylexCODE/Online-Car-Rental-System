<?php
    echo "<p class='carsFound'>260 Vehicles Found</p>";
    echo "<span class='scrollCars'>";
    $i = 1;
    // Image Dimensions height: 180px | width: 277.5px;
    while($i < 20){
        echo "<span class='car'>
            <img></img>
            <p>Ford Ranger</p>
            <p>₱3000/Day</p>
            <span>
                <img src='./images/icons/location-icon.svg' height='14px' width='14px'><p>Cebu</p>
            </span>
            <span>
                <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p>Continuously Variable</p>
            </span>
            <span>
                <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p>Gasoline</p>
            </span>
            <span>";
            if(isset($_SESSION["role"])){
                if($_SESSION["role"] == "Customer"){
                    echo "<button>Rent</button>";
                }else{
                    echo "<button>Edit</button>";
                }
            }else{
                echo "<button onclick='toggleSignupAlert(&#x27;show&#x27;)'>Rent</button>";
            }
            echo "</span>
        </span>";
        $i++;
    }
    echo "</span>";
?>