<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $brandID = $_POST["id"];

        $deleteQuery = "DELETE FROM brands WHERE BrandID = '$brandID'";
        try{
            mysqli_query($conn, $deleteQuery);
            echo "<span class='success'>Brand Deleted</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error1 Pre</span>";
        }
    }
?>