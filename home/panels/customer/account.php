<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_SESSION["userID"])){
        $id = $_SESSION["userID"];

        $query = "SELECT * FROM users WHERE UserID = $id";
        try{
            $execQuery = mysqli_query($conn, $query);

            $userInfo = mysqli_fetch_assoc($execQuery);
        }catch(mysqli_sql_exception){}
    }else{
        header("location: ../../../index.php");
    }

    if(isset($_POST["changePass"])){
        $oldPass = $_POST["oldPass"];
        $newPass = $_POST["newPass"];

        $query = "SELECT Password FROM users WHERE UserID = '" . $_SESSION["userID"] . "'";

        try{
            $execQuery = mysqli_query($conn, $query);

            $result = mysqli_fetch_assoc($execQuery);
            if(password_verify($oldPass, $result["Password"])){
                $hashPassword = password_hash($newPass, PASSWORD_DEFAULT);

                $query = "UPDATE users SET password = '$hashPassword' WHERE UserID = '" . $_SESSION["userID"] . "'";
                mysqli_query($conn, $query);
                header("location: ./account.php?passwordchanged");
            }else{
                header("location: ./account.php?wrongpassword");
            }
        }catch(mysqli_sql_exception){}
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            @font-face{
                font-family: space-grotesk-regular;
                url: ("../../../fonts/SpaceGrotesk-Regular.otf");
                src: url("../../../fonts/SpaceGrotesk-Regular.otf");
            }

            body {
                background-color: #316C40;
                display: grid;
                place-items: center;
                font-family: space-grotesk-regular;
                height: 100dvh;
                color: #FDFFF6;
                overflow: hidden;
            }

            p {
                border: 1px solid #E2F87B;
                padding: 5px 10px;
                border-radius: 5px;
            }

            body > span {
                animation: fadeIn 2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }
            
            .changePassWrapper input {
                background-color: #38814a;
                border-radius: 5px;
                border: 1px solid #E2F87B;
                padding: 10px;
                color: #FDFFF6;
            }

            .changePassWrapper input:nth-child(1) {
                margin-top: 20px;
            }
            
            .changePassWrapper label {
                margin-bottom: 10px;
                font-size: 14px;
                opacity: 0.8;
                transform: translateY(-56px);
            }

            .changePassWrapper label:nth-child(4) {
                margin-bottom: -5px;
            }

            .backBtn {
                position: fixed;
                top: 0px;
                right: 0px;
                margin: 10px;
                padding: 5px 20px;
                text-decoration: none;
                color: #FDFFF6;
                border: 1px solid #FDFFF6;
                border-radius: 5px;
                animation: fadeIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .errorMsg, .successMsg {
                color: #f44336;
                margin-block: 0px 0px;
                height: 0px;
                align-self: center;
                border: none;
            }
            
            .successMsg {
                color: #E2F87B;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to{
                    opacity: 1;
                }
            }
        </style>
        <title>My Account</title>
    </head>
    <body>
        <a onclick="window.close()" class='backBtn'>Back</a>
        <span>
            <div style="border: 2px solid #E2F87B; border-radius: 5px; padding: 10px 30px;">
                <h2>Account Information</h2>
                <p>Name: <?php echo $userInfo["Name"]; ?></p>
                <p>Email: <?php echo $userInfo["Email"]; ?></p>
                <p>Phone Number: <?php echo $userInfo["PhoneNumber"]; ?></p>
                <p>Date of Birth: <?php echo $userInfo["DoB"]; ?></p>
                <p>Drivers License: <?php echo $userInfo["DriversLicense"]; ?></p>
            </div>
            <br>
            <form method="post" class='changePassWrapper' style="border: 2px solid #E2F87B; border-radius: 5px; padding: 20px 30px; display: flex; flex-direction: column;">
                <input type="password" id="oldPass" name="oldPass">
                <label>Enter Old Password</label>

                <input type="password" id="newPass" name="newPass">
                <label>Enter New Password</label>

                <button id="submitBtn" name="changePass" style="border: none; background-color: #E2F87B; border-radius: 5px; padding: 5px 20px;">Change Password</button>
                <?php
                    if(isset($_GET["wrongpassword"])){
                        echo "<p class='errorMsg'>Wrong Password</p>";
                    }elseif(isset($_GET['passwordchanged'])){
                        echo "<p class='successMsg'>Password Changed Successfully</p>";
                    }else{
                        echo "<p class='errorMsg'> </p>";
                    }
                ?>
            </form>
        </span>
    </body>
    <script type="text/javascript">
        const oldPass = document.getElementById("oldPass");
        const newPass = document.getElementById("newPass");

        document.getElementById("submitBtn").addEventListener('click', (e) => {
            if(oldPass.value.trim() == "" || newPass.value.trim() == ""){
                e.preventDefault();
                document.querySelector(".errorMsg").innerHTML = "Empty Fields";
            }
        });
    </script>
</html>