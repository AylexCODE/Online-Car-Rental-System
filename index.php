<?php
    $conn = "";
    try{
        $conn = mysqli_connect("localhost", "root", "", "car_rental");
        //echo "Success";
    }catch(mysqli_sql_exception){
         echo "Error Tagak Pre!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#" type="image/x-icon">
    <title>Car Rental System</title>
</head>
<body>
    <h2>Login</h2>

    <p>Username</p>
    <input type="text">

    <p>Password</p>
    <input type="password">
</body>
</html>
