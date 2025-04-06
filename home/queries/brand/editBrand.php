<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $brandID = $_POST["brandID"];
        $newBrand = $_POST["newBrand"];

        $editQuery = "UPDATE Brands SET BrandName = '$newBrand' WHERE BrandID = '$brandID'";
        try{
            mysqli_query($conn, $editQuery);
            echo "<span class='success'>Brand Edited</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Brand Already Exist</span>";
        }
    }
?>