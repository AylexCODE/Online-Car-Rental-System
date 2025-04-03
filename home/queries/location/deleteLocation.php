<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $locationID = $_POST["id"];

        $deleteQuery = "DELETE FROM locations WHERE LocationID = '$locationID'";
        try{
            mysqli_query($conn, $deleteQuery);
            echo "<span class='success'>Location Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
        }
    }
?>