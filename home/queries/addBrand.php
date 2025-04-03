<?php
    include("../../database/db_conn.php");

    $queryGetBrands = "SELECT * FROM brands ORDER BY BrandName";

    if(isset($_POST)){
        $brand = filter_var($_POST["brand"], FILTER_SANITIZE_SPECIAL_CHARS);
        
        $query = "INSERT INTO brands VALUES (null, '$brand')";
        
        try{
            mysqli_query($conn, $query);
            echo "<span class='success'>Brand Added</span>";
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Brand Already Exist</span>";
         }
    }
?>