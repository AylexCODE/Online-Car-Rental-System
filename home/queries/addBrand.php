<?php
    include("../../database/db_conn.php");
    
    if(isset($_POST)){
        $brand = filter_var($_POST["brand"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $queryAddBrand = "INSERT INTO brands VALUES (null, '$brand')";

        try{
            mysqli_query($conn, $queryAddBrand);
            echo "<span class='success'>Brand Added</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Brand Already Exist</span>";
         }
    }
?>