<?php
    include("../database/db_conn.php");

    if(isset($_POST["login"])){
        $fName = filter_input(INPUT_POST, "FirstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lName = filter_input(INPUT_POST, "LastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $doB = $_POST["DoB"];
        $phoneNumber = $_POST["PhoneNumber"];
        $email = filter_input(INPUT_POST, "Email", FILTER_SANITIZE_SPECIAL_CHARS);
        $dLicense = filter_input(INPUT_POST, "DriversLicense", FILTER_SANITIZE_SPECIAL_CHARS);
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
    <form method="post" onsubmit="checkForm(event)">
        <p>First Name</p>
        <input type="text" name="FirstName" id="firstname">

        <p>Last Name</p>
        <input type="text" name="LastName" id="lastname">

        <p>Date of Birth</p>
        <input type="date" name="DoB" id="dob">

        <p>Email</p>
        <input type="email" name="Email" id="email">

        <p>Phone Number</p>
        <input type="number" name="PhoneNumber" id="phonenumber">

        <p>Drivers License</p>
        <input type="text" name="DriversLicense" id="dLicense">

        <p>Password</p>
        <input type="password" name="Password" id="password">

        <p>Confirm Password</p>
        <input type="password" name="ConfirmPassword" id="cPass">
        
        <br>
        <br>
        <p id="errorMsg"></p>
        <button type="submit" name="login">Submit</button>

        <p>Already have an account?</p>
        <a href="./login.php">login</a>
    </form>
</body>
<script type="text/javascript">
    const name = document.getElementById("firstname");
    const lname = document.getElementById("lastname");
    const dob = document.getElementById("dob");
    const email = document.getElementById("email");
    const phoneNo = document.getElementById("phonenumber");
    const dLicense = document.getElementById("dLicense");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("cPass");
    const errorMsg = document.getElementById("errorMsg");
    const emailRegex = /^[^\s@]+@[^\s@]+\.com+$/;

    function checkForm(event){
        event.preventDefault();

        if(name.value == "" || lname.value == "" || dob.value == "" || email.value == "" || phoneNo.value == "" || dLicense.value == "" || password.value == "" || confirmPassword.value == ""){
            errorMsg.innerHTML = "Fill all fields!";
        }else{
            clearErrorMsg();
        }
    }

    function checkPass(){
        if((password.value != confirmPassword.value) && (confirmPassword.value != "" && password.value != "")){
            errorMsg.innerHTML = "Password Does Not Match";
        }else{
            clearErrorMsg();
        }
    }

    function clearErrorMsg(){
        errorMsg.innerHTML = "";
    }

    password.oninput = (event) => { checkPass() }
    confirmPassword.oninput = (event) => { checkPass() }
    email.oninput = (event) => { if(!emailRegex.test(email.value)){errorMsg.innerHTML="Invalid Email!"}else{clearErrorMsg()} }
</script>
</html>