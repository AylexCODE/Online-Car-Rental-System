<?php
    include("../../database/db_conn.php");
    
    if(isset($_POST)){
        $address = filter_var($_POST["address"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $queryAddLocation = "INSERT INTO Locations VALUES (null, '$address')";

        try{
            mysqli_query($conn, $queryAddLocation);
            echo "<span class='success'>Location Added</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Location Already Exist</span>";
         }
    }
?>