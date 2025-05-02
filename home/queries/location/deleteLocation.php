<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");

    if(isset($_POST)){
        $locationID = $_POST["id"];

        $deleteQuery = "DELETE FROM locations WHERE LocationID = '$locationID'";
        try{
            mysqli_query($conn, $deleteQuery);
            recordLog($_SESSION["userID"], "Deleted Location WHERE ID is $locationID", $conn);
            echo "<span class='success'>Location Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Location Already Exist</span>";
        }
    }
?>