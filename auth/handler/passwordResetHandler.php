<?php
    session_start();
    require_once("../../database/db_conn.php");

    if(isset($_GET["contact"])){
        $contact = $_GET["contact"];
        
        $query = "SELECT UserID FROM users WHERE Email = '$contact' OR PhoneNumber = '$contact';";
        try{
            $execQuery = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($execQuery) != 0){
                echo "Ok";
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
            echo "Ok";
        }catch(mysqli_sql_exception){
          echo "Error";
        }
    }
?>