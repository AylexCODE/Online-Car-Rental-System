<?php
    include("../database/db_conn.php");

    if(isset($_POST["login"])){
        $fName = filter_input(INPUT_POST, "FirstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lName = filter_input(INPUT_POST, "LastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $doB = filter_input(INPUT_POST, "DoB");
        $email = filter_input(INPUT_POST, "Email", FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneNumber = filter_input(INPUT_POST, "PhoneNumber", FILTER_SANITIZE_SPECIAL_CHARS);
        $dLicense = filter_input(INPUT_POST, "DriversLicense", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "Password", FILTER_SANITIZE_SPECIAL_CHARS);
        $cPassword = filter_input(INPUT_POST, "ConfirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    }
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
        <p>First Name</p>
        <input type="text" name="FirstName">

        <p>Last Name</p>
        <input type="text" name="LastName">

        <p>Date of Birth</p>
        <input type="date" name="DoB">

        <p>Email</p>
        <input type="email" name="Email">

        <p>Phone Number</p>
        <input type="number" name="PhoneNumber">

        <p>Drivers License</p>
        <input type="text" name="DriversLicense">

        <p>Password</p>
        <input type="password" name="Password" id="password" onchange="checkPass()">

        <p>Confirm Password</p>
        <input type="password" name="ConfirmPassword" id="cPass" onchange="checkPass()">
        <p id="passErrorMsg"></p>

        <br>
        <button type="submit" name="login">Submit</button>

        <p>Already have an account?</p>
        <a href="./login.php">login</a>
    </form>
</body>
<script type="text/javascript">
    const passwordError = document.getElementById("passErrorMsg");
    
    function checkPass(){
        const pass = document.getElementById("password").value;
        const cPass = document.getElementById("cPass").value;

        if(pass != cPass){
            passwordError.innerHTML = "Password Does Not Match";
        }else{
            passwordError.innerHTML = "";
        }
    }
</script>
</html>