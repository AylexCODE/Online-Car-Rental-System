<?php
    include_once("./style.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }


        input[type="date"]::-webkit-calendar-picker-indicator {
            position: relative;
            bottom: 6px;
            right: 6px;
            filter: invert();
        }

        input[type="date"] + label {
            font-size: 12px;
            transform: translate(5.9px, -38px);
        }
        /*
        .msg {
            position: fixed;
            top: -100px;
            /* left: 50%; *//*
            z-index: 999;
            width: 100vw;
            height: fit-content;
            right: 0px;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }
        
        .msg > .error, .msg > .success, .notif > .success, .notif > .error {
            position: relative;
            color: rgb(255, 100, 100);
            /* right: 2.5%; *//*
            top: 50px;
            text-wrap: nowrap;
            border: 2px solid #F77;
            padding: 5px 10px;
            background-color: #38814a;
            font-weight: bold;
            border-radius: 5px;
            animation: msgSlideDown 5s cubic-bezier(0.19, 1, 0.22, 1);
        }
    
        .msg > .success, {
            color: #E2F87B;
            border: 2px solid #E2F87B;
        }
    
        @keyframes msgSlideDown {
            0%{
                opacity: 0;
            }
            30%{
                opacity: 1;
                top: 150px;
            }
            70%{
                opacity: 1;
                top: 150px;
            }
            100%{
                opacity: 0;
                top: 0px;
            }
        }
        */
    </style>
    <script src="../home/vendor/jquery-3.7.1.min.js"></script>
    <title>Car Rental</title>
</head>
<body>
    <h2>Welcome</h2>
    <p>Let's get you started!</p>
    <form method="post" onsubmit="checkForm(event)" class="signupForm">
      <div class="stepsWrapper">
        <section class="firstStep show">
            <h4>Basic Info</h4>
            <span class="fullName">
                <input type="text" name="FirstName" id="firstname" placeholder=" " spellcheck="false">
                <input type="text" name="LastName" id="lastname" placeholder=" " spellcheck="false">
                
                <label for="firstname">First Name</label>
                <label for="lastname">Last Name</label>
            </span>
            <input type="email" name="Email" id="email" placeholder=" " style="width: 275px;">
            <label for="email">Email</label>
            
            <input type="number" name="PhoneNumber" id="phonenumber" placeholder=" " style="width: 275px;">
            <label for="phonenumber">Phone Number</label>
        </section>
        <section class="secondStep">
            <h4>Personal Info</h4>
            <input type="date" name="DoB" id="doB" class="dob" style="width: 275px;">
            <label for="doB">Date of Birth</label>

            <input type="text" name="DriversLicense" id="dLicense" maxlength="13" placeholder=" " style="width: 275px;">
            <label for="dLicense">Drivers License</label>
    
            <input type="password" name="Password" id="password" placeholder=" " style="width: 275px;">
            <label for="password">Password</label>
        </section>
        
        <section class="lastStep">
            <h4>Review Info</h4>
            <input type="text" id="conName" disabled style="width: 275px;"></input>
            <label for="conName">Name</label>
            
            <input id="conEmail" disabled></input>
            <label for="conEmail">Email</label>
            
            <input id="conPhoneNum" disabled></input>
            <label for="conPhoneNum">Phone Number</label>
            
            
            <input id="conDoB" disabled></input>
            <label for="conDoB">Date of Birth</label>
            
            <input id="conDLicense" disabled></input>
            <label for="conDLicense">Driver's License</label>
            <hr>
            <input type="password" name="ConfirmPassword" id="cPass" placeholder=" ">
            <label for="cPass">Confirm Password</label>
        </section>
      </div>
      
        <div class="progress">
            <span class="progressBar"></span>
        </div>
        <p id="errorMsg"><?/*php if(isset($_GET["error"])){ if($_GET["error"] == "accountexist"){echo "Account Already Exist";} }*/?></p>
        <section class="navigation">
            <div class="previousButton" onclick="confirmStep('subtract')">Previous</div>
            <button type="submit" name="signup" class="nextButton" onclick="confirmStep('add')">Next</buttonu>
            <!--<button type="submit" name="signup">Submit</button>-->
        </section>
    </form>
    <div class="loginButton">
        <p>Already have an account?&nbsp;</p>
        <a href="./login.php">login</a>
    </div>
    <!--<p class="msg"><span class="success">Hello World!</span></p>-->
</body>
<script type="text/javascript">
    const stepWrapper = document.querySelector(".stepsWrapper");
    const progressBar = document.querySelector(".progressBar");
    
    const signupForm = document.querySelector(".signupForm");
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
    
    function confirmStep(step){
        event.preventDefault();
        setConfirmation();
        if(step == "subtract") setStep(step);
        
        if(steps == 1){
            //event.preventDefault();
            if(checkFirstStep()){
                if(step != "subtract") setStep(step);
                setShowingForms();
            }
        }else if(steps == 2){
            //event.preventDefault();
            if(checkSecondStep()){
                if(step != "subtract") setStep(step);
                setShowingForms();
            }
        }else if(confirmPass()){
            //event.preventDefault();
            $.ajax({
                type: 'post',
                url: './handler/signupHandler.php',
                data: { type: 'register', FirstName: fname.value, LastName: lname.value, PhoneNumber: phoneNo.value, Email: email.value, DriversLicense: dLicense.value, Password: password.value, DoB: dob.value },
                success: function(res){
                    if(res == "accountcreated"){
                        window.location.replace("./login.php?accountcreated");
                    }else{
                        
                    }
                },
                error: function(){}
            });
        }else{
            event.preventDefault();
        }
    }
    
    function setStep(step){
        switch(step){
            case "add":
                if(steps < 3) steps++;
                break;
            case "subtract":
                if(steps > 1) steps--;
                break;
        }
    }
    
    function setShowingForms(){
        switch(steps){
            case 1:
                stepWrapper.style.right = "0px";
                document.querySelector(".stepsWrapper").style.height = "219px";
                document.querySelector(".signupForm").style.height = "340px";
                document.querySelector(".previousButton").style.opacity = "0";
                document.querySelector(".secondStep").style.visibility = "hidden";
                progressBar.style.width = "33.3%";
                break;
            case 2:
                stepWrapper.style.right = "325px";
                document.querySelector(".stepsWrapper").style.height = "219px"
                document.querySelector(".signupForm").style.height = "340px";
                document.querySelector(".previousButton").style.opacity = "1";
                document.querySelector(".previousButton").innerHTML = "Previous";
                document.querySelector(".nextButton").innerHTML = "Next";
                document.querySelector(".secondStep").style.visibility = "visible";
                document.querySelector(".lastStep").style.visibility = "hidden";
                progressBar.style.width = "66.6%";
                break;
            case 3:
                stepWrapper.style.right = "650px";
                document.querySelector(".stepsWrapper").style.height = "385px";
                document.querySelector(".signupForm").style.height = "505px";
                document.querySelector(".previousButton").innerHTML = "Back";
                document.querySelector(".nextButton").innerHTML = "Submit";
                document.querySelector(".lastStep").style.visibility = "visible";
                progressBar.style.width = "100%";
                break;
        }
    }
    
    function setConfirmation(){
        document.getElementById("conName").value = fname.value +" " +lname.value;
        document.getElementById("conEmail").value = email.value;
        document.getElementById("conPhoneNum").value = phoneNo.value;
        document.getElementById("conDoB").value = dob.value;
        document.getElementById("conDLicense").value = dLicense.value;
    }
    
    function checkFirstStep(){
        let isTrue = true;
        
        if(fname.value == ""){
            fname.style.borderColor = "red";
            isTrue = false;
        }if(lname.value == ""){
            lname.style.borderColor = "red";
            isTrue = false;
        }if(phoneNo.value == "" || phoneNo.value.length < 11 || !phoneNo.value.startsWith("09")){
            errorMsg.innerHTML = "Invalid Phone Number";
            phoneNo.style.borderColor = "red";
            isTrue = false;
        }if(email.value == "" || !emailRegex.test(email.value)){
            errorMsg.innerHTML = "Invalid Email";
            email.style.borderColor = "red";
            isTrue = false;
        }
        
        if(fname.value == "" || lname.value == "" || email.value == "" || phoneNo.value == ""){
            errorMsg.innerHTML = "Please Fill All Fields";
            isTrue = false;
        }
        return isTrue;
    }
    
    function checkSecondStep(){
        let isTrue = true;
        
        if(!checkPass()){
            isTrue = false;
        }if(dLicense == "" || !dLicenseRegex.test(dLicense.value)){
            errorMsg.innerHTML = "Invalid Driver's License";
            dLicense.style.borderColor = "red";
            isTrue = false;
        }if(dob.value == ""){
            dob.style.borderColor = "red";
            isTrue = false;
        }if(!checkDriveAge()){
            errorMsg.innerHTML = "You Must Be Atleast 18 Years Old";
            isTrue = false;
        }
        
        if(dob.value == "" || dLicense.value == "" || password.value == ""){
            errorMsg.innerHTML = "Please Fill All Fields";
            isTrue = false;
        }
        return isTrue;
    }
    
    let dLLength = 0;
    function formatDLicense(){
        if(dLicense.value.length > dLLength){
            if(dLicense.value.length == 3){
                dLicense.value = dLicense.value +"-";
            }else if(dLicense.value.length == 6){
                dLicense.value = dLicense.value +"-";
            }
        }
        dLLength = dLicense.value.length;
    }
    
    function checkPass(){
        let isTrue = false;
        password.style.borderColor = "red";
        
        if(password.value.length < 8){
            errorMsg.innerHTML = "Password Must Be Atleast 8 Characters";
        }else if(password.value.search(/[a-z]/) < 0){
            errorMsg.innerHTML = "Password Must Contain Atleast One Small Letter";
        }else if(password.value.search(/[A-Z]/) < 0){
            errorMsg.innerHTML = "Password Must Contain Atleast One Capital Letter";
        }else if(password.value.search(/[0-9]/) < 0){
            errorMsg.innerHTML = "Password Must Contain Atleast One Digit";
        }else{
            password.style.borderColor = "green";
            isTrue = true;
        }
        
        return isTrue;
    }
    
    function confirmPass(){
        let isTrue = true;
        if(password.value != confirmPassword.value){
            errorMsg.innerHTML = "Passwords Doesn't Match";
            confirmPassword.style.borderColor = "red";
            isTrue = false;
        }else{
            confirmPassword.style.borderColor = "green";
        }
        
        return isTrue;
    }
    
    function checkDriveAge(){
        let isTrue = true;
        let ageYear = (dob.value).split("-");
        const currentDate = new Date();
        
        ageYear = new Date((parseInt(ageYear[0])+18) +"-" +ageYear[1] +"-" +ageYear[2]);
        if(ageYear > currentDate){
            dob.style.borderColor = "red";
            isTrue = false;
        }
        
        return isTrue;
    }
    
    function resetEverything(){
        errorMsg.innerHTML = "";
        if(fname.value == "") fname.style.borderColor = "#00000000";
        if(lname.value == "") lname.style.borderColor = "#00000000";
        if(email.value == "") email.style.borderColor = "#00000000";
        if(phoneNo.value == "") phoneNo.style.borderColor = "#00000000";
        if(dob.value == "") dob.style.borderColor = "#00000000";
        if(dLicense == "") dLicense.style.borderColor = "#00000000";
        if(password.value == "") password.style.borderColor = "#00000000";
    }
    
    fname.oninput = (event) => { resetEverything(); if(fname.value != ""){fname.style.borderColor = "green"}else{fname.style.borderColor = "#00000000"} }
    lname.oninput = (event) => { resetEverything(); if(lname.value != ""){lname.style.borderColor = "green"}else{lname.style.borderColor = "#00000000"} }
    email.oninput = async (event) => { resetEverything(); if(!emailRegex.test(email.value) && email.value != "" || await checkExist(event.target.value, "checkemail") == false){email.style.borderColor = "red"}else{email.style.borderColor = "green"} if(email.value == "")email.style.borderColor = "#00000000" }
    phoneNo.oninput = async (event) => { resetEverything(); if(phoneNo.value.length < 11 && phoneNo.value != "" && !phoneNo.value.startsWith("09")){phoneNo.style.borderColor = "red"}else{phoneNo.value = phoneNo.value.slice(0, 11);if(phoneNo.value.startsWith("09")){phoneNo.style.borderColor = "green";if(phoneNo.value.length < 11 && phoneNo.value.length > 2 || await checkExist(event.target.value, "checkphone") == false){phoneNo.style.borderColor = "red";}} }if(phoneNo.value == ""){phoneNo.style.borderColor = "#00000000"} }
    dob.onchange = (event) => { resetEverything(); checkDriveAge(); if(dob.value != ""){dob.classList.add("dobNotEmpty"); dob.style.borderColor = "green";}else{dob.classList.remove("dobNotEmpty"); dob.style.borderColor = "#00000000"} checkDriveAge(); }
    dLicense.oninput = async (event) => { resetEverything(); formatDLicense(); if(dLicense.value == ""){dLicense.style.borderColor = "#00000000"} if(!dLicenseRegex.test(dLicense.value) && dLicense.value != "" || await checkExist(event.target.value, "checklicense") == false){dLicense.style.borderColor = "red"}else{dLicense.style.borderColor = "green"} }
    password.oninput = (event) => { if(steps != 2){return 0} resetEverything(); checkPass(); if(password.value == ""){password.style.borderColor = "#00000000"} }
    confirmPassword.oninput = (event) => { resetEverything(); confirmPass(); if(confirmPassword.value == "") confirmPassword.style.borderColor = "#00000000" }
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
*//*
    password.oninput = (event) => { checkPass() }
    confirmPassword.oninput = (event) => { checkPass() }
    email.oninput = (event) => { checkRequired(); if(!emailRegex.test(email.value) && email.value != "" && email.value.length > 9){errorMsg.innerHTML="Invalid Email!"} }
    phoneNo.oninput = (event) => { checkRequired(); if(phoneNo.value.length < 11 && phoneNo.value != ""){errorMsg.innerHTML="Invalid Phone Number!"}else{phoneNo.value = phoneNo.value.slice(0, 11)} }
    dLicense.oninput = (event) => { checkRequired(); if(!dLicenseRegex.test(dLicense.value) && dLicense.value != ""){errorMsg.innerHTML="Invalid Driver's License!"} }
    */
    async function checkExist(value, type){
       let isOk = false;
       await $.ajax({
         type: 'post',
         url: './handler/signupHandler.php',
         data: { value, value, type: type },
         success: function(res){
           if(res == "OK"){
             $("#errorMsg").html('');
             isOk = true;
           }else{
             $("#errorMsg").html(res);
           }
           console.log(res)
         },
         error: function(){}
       });
       
       return isOk;
    }
</script>
</html>
