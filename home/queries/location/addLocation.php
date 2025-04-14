<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_POST)){
        $address = filter_var($_POST["location"], FILTER_SANITIZE_SPECIAL_CHARS);
        $addressCode = filter_var($_POST["address"], FILTER_SANITIZE_SPECIAL_CHARS);
        $distance = filter_var($_POST["distance"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $queryAddLocation = "INSERT INTO locations VALUES (null, '$address', '$addressCode', '$distance')";

        try{
            mysqli_query($conn, $queryAddLocation);
            echo "<span class='success'>Location Added</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Location Already Exist</span>";
         }
    }
?>