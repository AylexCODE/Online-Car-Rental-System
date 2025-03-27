<?php
    require("../database/db_conn.php");
    include_once("./style.php");

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
    <title>Car Rental</title>
</head>
<body>
    <form method="post" onsubmit="checkForm(event)">
        <section class="firstStep show">
            <span class="fullName">
                <input type="text" name="FirstName" id="firstname" placeholder=" " spellcheck="false">
                <input type="text" name="LastName" id="lastname" placeholder=" " spellcheck="false">
                
                <label for="firstname">First Name</label>
                <label for="lastname">Last Name</label>
            </span>
            <input type="email" name="Email" id="email" placeholder=" ">
            <label for="email">Email</label>
            
            <input type="number" name="PhoneNumber" id="phonenumber" placeholder=" ">
            <label for="phonenumber">Phone Number</label>
        </section>
        <section class="secondStep">
            <input type="date" name="DoB" id="doB" class="dob">
            <label for="dob">Date of Birth</label>
            
            <input type="text" name="DriversLicense" id="dLicense" maxlength="13" placeholder=" ">
            <label for="dLicense">Drivers License</label>
    
            <input type="password" name="Password" id="password" placeholder=" ">
            <label for="password">Password</label>
        </section>
        
        <section class="lastStep">
            <input type="text" id="conName" disabled></input>
            <label for="conName">Name</label>
            
            <input id="conEmail"></input>
            <label for="conEmail">Email</label>
            
            <input id="conPhoneNum"></input>
            <label for="conDLicense">Phone Number</label>
            
            <input id="conDoB"></input>
            <label for="conDoB">Date of Birth</label>
            
            <input id="conDLicense"></input>
            <label for="conDLicense">Driver's License</label>
            
            <input type="password" name="ConfirmPassword" id="cPass" placeholder=" ">
            <label for="cPass">Confirm Password</label>
        </section>
        
        <!--<p id="errorMsg"></p>-->
        <section class="navigation">
            <div class="previousButton" onclick="setStep('subtract')">Previous</div>
            <div class="nextButton" onclick="setStep('add')">Next</div>
            <!--<button type="submit" name="signup">Submit</button>-->
        </section>
    </form>
    <div class="loginButton">
        <p>Already have an account?&nbsp;</p>
        <a href="./login.php">login</a>
    </div>
</body>
<script type="text/javascript">
    const firstStep = document.querySelector(".firstStep");
    const secondStep = document.querySelector(".secondStep");
    const lastStep = document.querySelector(".lastStep");
    const allSteps = [firstStep, secondStep, lastStep];
    
    const fname = document.getElementById("firstname");
    const lname = document.getElementById("lastname");
    const dob = document.querySelector(".dob");
    const email = document.getElementById("email");
    const phoneNo = document.getElementById("phonenumber");
    const dLicense = document.getElementById("dLicense");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("cPass");
    const errorMsg = document.getElementById("errorMsg");

    const emailRegex = /^[^\s@]+@[e|g|E|G]+mail+\.com+$/;
    const dLicenseRegex = /^[a-zA-Z0-9]{3}\-[a-zA-Z0-9]{2}\-[a-zA-Z0-9]{6}$/;
    
    let requirementsMeet = false;
    let steps = 1;
    
    function setStep(step){
        switch(step){
            case "add":
                if(steps < 3) steps++;
                break;
            case "subtract":
                if(steps > 1) steps--;
                break;
        }
        
        if(steps == 3) setConfirmation();
        setShowingForms();
    }
    
    function setShowingForms(){
        let index = 1;
        allSteps.forEach((element)=>{
            if(index == steps){
                element.classList.add("show");
            }else{
                element.classList.remove("show");
            }
            index++;
        });
    }
    
    function setConfirmation(){
        document.getElementById("conName").value = fname.value +" " +lname.value;
        document.getElementById("conEmail").value = email.value;
        document.getElementById("conPhoneNum").value = phoneNo.value;
        document.getElementById("conDoB").value = dob.value;
        document.getElementById("conDLicense").value = dLicense.value;
    }
    
    dob.onchange = (event) => { if(dob.value != ""){dob.classList.add("dobNotEmpty")}else{dob.classList.remove("dobNotEmpty")} }
    /*
    function checkForm(event){
        if(fname.value == "" || lname.value == "" || dob.value == "" || email.value == "" || phoneNo.value == "" || dLicense.value == "" || password.value == "" || confirmPassword.value == ""){
            errorMsg.innerHTML = "Fill all fields!";
            event.preventDefault();
        }else{
            requirementsMeet = true;
            clearErrorMsg();
            checkRequired();
            checkPass();
            checkDriveAge();
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
        if(!emailRegex.test(email.value) && email.value != "" && email.value.length > 9){
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
    
    function checkDriveAge(){
      let ageYear = (dob.value).split("-");
      const currentDate = new Date();
      
      ageYear = new Date((parseInt(ageYear[0])+18) +"-" +ageYear[1] +"-" +ageYear[2]);
      if(ageYear > currentDate){
        requirementsMeet = false;
      }
    }

    password.oninput = (event) => { checkPass() }
    confirmPassword.oninput = (event) => { checkPass() }
    email.oninput = (event) => { checkRequired(); if(!emailRegex.test(email.value) && email.value != "" && email.value.length > 9){errorMsg.innerHTML="Invalid Email!"} }
    phoneNo.oninput = (event) => { checkRequired(); if(phoneNo.value.length < 11 && phoneNo.value != ""){errorMsg.innerHTML="Invalid Phone Number!"}else{phoneNo.value = phoneNo.value.slice(0, 11)} }
    dLicense.oninput = (event) => { checkRequired(); if(!dLicenseRegex.test(dLicense.value) && dLicense.value != ""){errorMsg.innerHTML="Invalid Driver's License!"} }
    */
</script>
</html>