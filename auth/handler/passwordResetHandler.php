<?php
    session_start();
    require_once("../../database/db_conn.php");
    require_once("../../home/queries/record_logs.php");

    if(isset($_GET["contact"])){
        $contact = $_GET["contact"];
        
        $query = "SELECT UserID, Name, Email FROM users WHERE Email = '$contact' OR PhoneNumber = '$contact';";
        try{
            $execQuery = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($execQuery) != 0){
                $result = mysqli_fetch_assoc($execQuery);
                echo "<form id='userInfo'>
                        <input type='hidden' name='email' value='" . $result["Email"] . "'>
                        <input type='hidden' name='name' value='" . $result["Name"] . "'>
                        <input type='hidden' name='passcode' id='verificationCode'>
                      </form>";
                $_SESSION["tempUserID"] = $result["UserID"];
            }else{
                echo "Account is not registered";
            }
        }catch(mysqli_sql_exception){}
    }
    
    if(isset($_POST["contact"])){
        $contact = $_POST["contact"];
        $newPassword = filter_var($_POST["newPassword"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $_SESSION["TempEmail"] = $contact;
        $encryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '$encryptedPassword' WHERE Email = '$contact' OR PhoneNumber = '$contact';";
        try{
            mysqli_query($conn, $query);
            
            recordLog($_SESSION["tempUserID"], "Changed Password", $conn);
            echo "Ok";
        }catch(mysqli_sql_exception){
          echo "Error";
        }
    }
?>