<?php
    include("../database/db_conn.php");
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
    <form method="post">
        <p>Email or Phone</p>
        <input type="text">

        <p>Password</p>
        <input type="password">

        <br>
        <button type="submit">Login</button>

        <p>Don't have an account?</p>
        <a href="./signup.php">Signup</a>
    </form>
</body>
</html>