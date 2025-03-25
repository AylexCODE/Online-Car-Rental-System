<?php
    include("../database/db_conn.php");

    if(isset($_POST["signup"])){
        $fName = filter_input(INPUT_POST, "FirstName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lName = filter_input(INPUT_POST, "LastName", FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneNumber = $_POST["PhoneNumber"];
        $email = strtolower(filter_input(INPUT_POST, "Email", FILTER_SANITIZE_SPECIAL_CHARS));

        // $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE Name = '$fName $lname' OR PhoneNumber = '$phoneNumber' OR Email = '$email';");

        $doB = $_POST["DoB"];
        $dLicense = filter_input(INPUT_POST, "DriversLicense", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "Password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // if(mysqli_num_rows($checkAccount) != 0){
        //     header("location: ./signup.php?accountexist");
        // }else{
            $query = "INSERT INTO users (Name, PhoneNumber, Email, DoB, DriversLicense, Role, Password, DateCreated) VALUES ('$fName $lName', '$phoneNumber', '$email', '$doB', '$dLicense', 'Customer', '$hashPassword', NOW());";
            try{
                header("location: ./login.php?noerror");
                mysqli_query($conn, $query);
            }catch(mysqli_sql_exception){
                header("location: ./signup.php?accountexist");
            }
        // }
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
        <input type="text" name="DriversLicense" id="dLicense" maxlength="13">

        <p>Password</p>
        <input type="password" name="Password" id="password">

        <p>Confirm Password</p>
        <input type="password" name="ConfirmPassword" id="cPass">
        
        <br>
        <br>
        <p id="errorMsg"></p>
        <button type="submit" name="signup">Submit</button>

        <p>Already have an account?</p>
        <a href="./login.php">login</a>
    </form>
</body>
<script type="text/javascript">
    const fname = document.getElementById("firstname");
    const lname = document.getElementById("lastname");
    const dob = document.getElementById("dob");
    const email = document.getElementById("email");
    const phoneNo = document.getElementById("phonenumber");
    const dLicense = document.getElementById("dLicense");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("cPass");
    const errorMsg = document.getElementById("errorMsg");

    const emailRegex = /^[^\s@]+@[e|g|E|G]+mail+\.com+$/;
    const dLicenseRegex = /^[a-zA-Z0-9]{3}\-[a-zA-Z0-9]{2}\-[a-zA-Z0-9]{6}$/;
    let requirementsMeet = false;

    function checkForm(event){
        if(fname.value == "" || lname.value == "" || dob.value == "" || email.value == "" || phoneNo.value == "" || dLicense.value == "" || password.value == "" || confirmPassword.value == ""){
            errorMsg.innerHTML = "Fill all fields!";
            event.preventDefault();
        }else{
            requirementsMeet = true;
            clearErrorMsg();
            checkRequired();
            checkPass();
            if(!requirementsMeet){
                event.preventDefault();
            }
        }
    }

    function checkPass(){
        if((password.value != confirmPassword.value) && (confirmPassword.value != "" && password.value != "")){
            errorMsg.innerHTML = "Password Does Not Match";
            requirementsMeet = false;
        }else{
            clearErrorMsg();
        }
    }

    function checkRequired(){
        if(!emailRegex.test(email.value) && email.value != ""){
            errorMsg.innerHTML="Invalid Email!";
            requirementsMeet = false;
        }else if(phoneNo.value.length < 11 && phoneNo.value != ""){
            errorMsg.innerHTML="Invalid Phone Number!";
            requirementsMeet = false;
        }else if(!dLicenseRegex.test(dLicense.value) && dLicense.value != ""){
            errorMsg.innerHTML="Invalid Driver's License!";
            requirementsMeet = false;
        }else{
            clearErrorMsg();
            checkPass();
        }
    }

    function clearErrorMsg(){
        errorMsg.innerHTML = "";
    }

    password.oninput = (event) => { checkPass() }
    confirmPassword.oninput = (event) => { checkPass() }
    email.oninput = (event) => { checkRequired(); if(!emailRegex.test(email.value) && email.value != ""){errorMsg.innerHTML="Invalid Email!"} }
    phoneNo.oninput = (event) => { checkRequired(); if(phoneNo.value.length < 11 && phoneNo.value != ""){errorMsg.innerHTML="Invalid Phone Number!"}else{phoneNo.value = phoneNo.value.slice(0, 11)} }
    dLicense.oninput = (event) => { checkRequired(); if(!dLicenseRegex.test(dLicense.value) && dLicense.value != ""){errorMsg.innerHTML="Invalid Driver's License!"} }
</script>
</html>