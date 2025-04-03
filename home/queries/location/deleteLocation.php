<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $address = $_POST["location"];

        $deleteQuery = "DELETE FROM locations WHERE Address = '$address'";
        echo $address;
        try{
            mysqli_query($conn, $deleteQuery);
            echo "<span class='success'>Location Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
        }
    }
?>