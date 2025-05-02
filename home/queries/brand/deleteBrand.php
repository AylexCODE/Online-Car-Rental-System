<?php
    require_once("../../../database/db_conn.php");
    session_start();

    if(isset($_POST)){
        $brandID = $_POST["id"];

        $deleteQuery = "DELETE FROM brands WHERE BrandID = '$brandID'";
        try{
            mysqli_query($conn, $deleteQuery);
            recordLog($_SESSION["userID"], "Deleted Brand ID $brandId", $conn);
            echo "<span class='success'>Brand Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
        }
    }
?>