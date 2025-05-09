<?php
    require_once("../../database/db_conn.php");
    require_once("../../home/queries/record_logs.php");
    
    if(isset($_POST)){
      if($_POST["type"] == "checkemail"){
        $email = filter_var($_POST["value"], FILTER_SANITIZE_SPECIAL_CHARS);
        $checkEmailQuery = "SELECT Email FROM users WHERE Email = '$email'";
        
        try{
          $getResult = mysqli_query($conn, $checkEmailQuery);
          
          if(mysqli_num_rows($getResult) > 0){
            echo "Email Already Taken";
          }else{
            echo "OK";
          }
        }catch(mysqli_sql_exception){}
      }elseif($_POST["type"] == "checkphone"){
        $phone = filter_var($_POST["value"], FILTER_SANITIZE_SPECIAL_CHARS);
        $checkPhoneQuery = "SELECT PhoneNumber FROM users WHERE PhoneNumber = '$phone'";
        
        try{
          $getResult = mysqli_query($conn, $checkPhoneQuery);
          
          if(mysqli_num_rows($getResult) > 0){
            echo "Phone Number Already Taken";
          }else{
            echo "OK";
          }
        }catch(mysqli_sql_exception){}
      }elseif($_POST["type"] == "checklicense"){
        $dlicense = filter_var($_POST["value"], FILTER_SANITIZE_SPECIAL_CHARS);
        $checkLicenseQuery = "SELECT DriversLicense FROM users WHERE DriversLicense = '$dlicense'";
        
        try{
          $getResult = mysqli_query($conn, $checkLicenseQuery);
          
          if(mysqli_num_rows($getResult) > 0){
            echo "License Already Taken";
          }else{
            echo "OK";
          }
        }catch(mysqli_sql_exception){}
      }else{
        $fName = filter_var($_POST["FirstName"], FILTER_SANITIZE_SPECIAL_CHARS);
        $lName = filter_var($_POST["LastName"], FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneNumber = $_POST["PhoneNumber"];
        $email = strtolower(filter_var($_POST["Email"], FILTER_SANITIZE_SPECIAL_CHARS));

        // $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE Name = '$fName $lname' OR PhoneNumber = '$phoneNumber' OR Email = '$email';");

        $doB = $_POST["DoB"];
        $dLicense = filter_var($_POST["DriversLicense"], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST["Password"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // if(mysqli_num_rows($checkAccount) != 0){
        //     header("location: ./signup.php?accountexist");
        // }else{
            $query = "INSERT INTO users (Name, PhoneNumber, Email, DoB, DriversLicense, Role, Password, DateCreated) VALUES ('$fName $lName', '$phoneNumber', '$email', '$doB', '$dLicense', 'Customer', '$hashPassword', NOW());";
            try{
                //header("location: ./login.php?success=accountcreated");
                mysqli_query($conn, $query);
                
                $getUserID = "SELECT UserID FROM users WHERE Name = '$fName $lName';";
                $execGetUserID = mysqli_query($conn, $getUserID);
                $userID = mysqli_fetch_assoc($execGetUserID);
                recordLog($userID["UserID"], "Signup", $conn);
                echo "accountcreated";
            }catch(mysqli_sql_exception){
                echo "accountexist";
            }
        // }
      }
    }
?>