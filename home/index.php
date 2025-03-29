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
            echo "<nav>
                    <span>
                        <h3>Quick Ride</h3>
                        <p>09218912891</p>
                        <button>Home</button>
                        <button>About</button>
                        <button>Contact</button>
                    </span>
                    <span>
                        <a href='../auth/logout.php'>logout</a>
                    </span>";
        }
    }else{
        echo "<nav>
                <span>
                    <h3>Quick Ride</h3>
                    <button>Home</button>
                    <button>About</button>
                    <button>Contact</button>
                </span>
                <span>
                    <a href='../auth/login.php'>Sign In</a>
                    <a href='../auth/signup.php'>Sign Up</a>
                </span>
            </nav>";

        echo "<div class=''>";
    }

    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Admin"){
            echo "<button>Dashboard</button><br>
                  <button>Brands</button><br>
                  <button>Vehicles</button><br>
                  <button>Locations</button><br>
                  <button>Bookings</button><br>
                  <button>Users</button><br>
                  <button>Tickets</button>";
        }else{
            echo "
            <section class='rentStatusWrapper'>
                <div class='userRentStatus'>
                    <span class='pickupLocation'>
                        <p>Pick Location</p>
                        <p>8912 Balilihan, Cebu</p>
                    </span>
                    <span class='pickupTime'>
                        <p>Pickup Time</p>
                        <p>09:00pm</p>
                    </span>
                    <span class='pickupDate'>
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
                </div>
            </section>
            <section class='carsDisplay'>
                <div class='carsFilter'>
                    <span>
                        <select>
                            <option>Transmission</option>
                        </select>
                        <select>
                            <option>Brands</option>
                        </select>
                        <select>
                            <option>Fuel Type</option>
                        </select>
                        <select>
                            <option>Model</option>
                        </select>
                        <button>Clear All Filter</button>
                    </span>
                    <span>
                        <select>
                            <option>Sort by</option>
                        </select>
                    </span>
                </div>
                <h3>260 Vehicles Found</h3>
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
        }
    }else{

    }
?>
</body>
</html>
