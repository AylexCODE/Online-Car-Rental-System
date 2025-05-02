<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");
    session_start();
    
    if(isset($_POST)){
        $brand = filter_var($_POST["brand"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $queryAddBrand = "INSERT INTO brands VALUES (null, '$brand')";

        try{
            mysqli_query($conn, $queryAddBrand);
            recordLog($_SESSION["userID"], "Added New Brand $brand", $conn);
            echo "<span class='success'>Brand Added</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Brand Already Exist</span>";
         }
    }
?>