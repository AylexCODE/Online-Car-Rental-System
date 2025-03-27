<?php
  session_start();
  require("../database/db_conn.php");
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
    if($_SESSION["role"] == "Admin"){
      echo "<button>Dashboard</button><br>
            <button>Brands</button><br>
            <button>Vehicles</button><br>
            <button>Locations</button><br>
            <button>Bookings</button><br>
            <button>Users</button><br>
            <button>Tickets</button>";
    }elseif($_SESSION["role"] == "Customer"){
      $carQuery = "SELECT brands.BrandName AS Brand, car.Model, car.FuelType, car.Transmission, car.RentalPrice, (SELECT locations.Address FROM locations WHERE car.locationID = locations.LocationID) AS Location, car.Availability FROM cars AS car INNER JOIN brands ON car.BrandID = brands.BrandID";
      
      $execQuery = mysqli_query($conn, $carQuery);
      while($car = mysqli_fetch_assoc($execQuery)){
        echo "Brand: " . $car["Brand"] . "<br>";
        echo "Model: " . $car["Model"] . "<Br>";
        echo "Fuel Type: " . $car["FuelType"] . "<Br>";
        echo "Transmission: " . $car["Transmission"] . "<Br>";
        echo "Price/Day: " . $car["RentalPrice"] . "<Br>";
        echo "Location: " . $car["Location"] . "<Br>";
        echo "Is Available: ";
        echo $car["Availability"] == 0 ? "False" : "True";
        echo "<br><br>";
      }
    }else{
      echo "No Account Detected!";
    }
  ?>
</body>
</html>
