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
            <button>Bookings</button><br>
            <button>Users</button><br>
            <button>Tickets</button>";
    }elseif($_SESSION["role"] == "Customer"){
      $carQuery = "SELECT * FROM cars";
      
      $execQuery = mysqli_query($conn, $carQuery);
      while($car = mysqli_fetch_assoc($execQuery)){
        echo "Brand: " . $car["BrandID"] . "<br>";
        echo "Model: " . $car["Model"] . "<Br>";
      }
    }else{
      echo "No Account Detected!";
    }
  ?>
</body>
</html>
