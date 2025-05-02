<?php
    require_once("../../../database/db_conn.php");
    session_start();

    if(isset($_POST)){
        $brandID = $_POST["brandID"];
        $newBrand = $_POST["newBrand"];

        $editQuery = "UPDATE brands SET BrandName = '$newBrand' WHERE BrandID = '$brandID'";
        try{
            mysqli_query($conn, $editQuery);
            recordLog($_SESSION["userID"], "Edited Brand ID $brandID New Brand Name is $newBrand", $conn);
            echo "<span class='success'>Brand Edited</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Brand Already Exist</span>";
        }
    }
?>
