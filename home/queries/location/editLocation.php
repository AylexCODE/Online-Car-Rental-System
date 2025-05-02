<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");
    session_start();

    if(isset($_POST)){
        $locationID = $_POST["id"];
        $newAddress = $_POST["address"];

        $editLocationQuery = "UPDATE Locations SET Address = '$newAddress' WHERE LocationID = '$locationID'";
        try{
            mysqli_query($conn, $editLocationQuery);
            recordLog($_SESSION["userID"], "Edited Location ID $locationID, SET Address To \"$newAddress\"", $conn);
            echo "<span class='success'>Location Edited</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Location Already Exist</span>";
        }
    }
?>