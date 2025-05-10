<?php
    require_once("../../database/db_conn.php");

    if(isset($_GET)){
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
?>