<?php
    echo "<section class='rentStatusWrapper guestBG'>
            <span style='background-image: url( &#x27;./images/backgrounds/homeBG.jpg &#x27;); background-repeat: no-repeat; background-size: cover; background-position: top;'>
                <div class='userRentStatus'>
                    <span>
                        <span class='pickupLocation'>
                            <p>Pick Location</p>
                            <p>8912 Balilihan, Cebu</p>
                        </span>
                        <span class='startTime'>
                            <p>Pickup Time</p>
                            <p>09:00pm</p>
                        </span>
                        <span class='startDate'>
                            <p>Pickup Date</p>
                            <p>Jun 19, 2022</p>
                        </span>
                        <span class='returnDate'>
                            <p>Return Date</p>
                            <p>July 19, 2022</p>
                        </span>
                        <span class='returnTime'>
                            <p>Return Date</p>
                            <p>Jun 19, 2022</p>
                        </span>
                    </span>
                </div>
            </span>
        </section>
        ";

        // $carQuery = "SELECT brands.BrandName AS Brand, car.Model, car.FuelType, car.Transmission, car.RentalPrice, (SELECT locations.Address FROM locations WHERE car.locationID = locations.LocationID) AS Location, car.Availability FROM cars AS car INNER JOIN brands ON car.BrandID = brands.BrandID";
        
        // $execQuery = mysqli_query($conn, $carQuery);
        // while($car = mysqli_fetch_assoc($execQuery)){
        //     echo "Brand: " . $car["Brand"] . "<br>";
        //     echo "Model: " . $car["Model"] . "<Br>";
        //     echo "Fuel Type: " . $car["FuelType"] . "<Br>";
        //     echo "Transmission: " . $car["Transmission"] . "<Br>";
        //     echo "Price/Day: " . $car["RentalPrice"] . "<Br>";
        //     echo "Location: " . $car["Location"] . "<Br>";
        //     echo "Is Available: ";
        //     echo $car["Availability"] == 0 ? "False" : "True";
        //     echo "<br><br>";
        // }
?>