<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $brand = $_POST["brand"];

        $deleteQuery = "DELETE FROM brands WHERE BrandName = '$brand'";
        try{
            mysqli_query($conn, $deleteQuery);
            echo "<span class='success'>Brand Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error1 Pre</span>";
        }
    }
?>