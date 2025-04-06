<?php
    require_once("../../../database/db_conn.php");

    $queryGetBrands = "SELECT * FROM brands ORDER BY BrandName";
    
    if(isset($_GET)){
        try{
            $execQueryGetBrands = mysqli_query($conn, $queryGetBrands);
            
            if(mysqli_num_rows($execQueryGetBrands) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetBrands)){
                    echo "<option value='" . $rows["BrandID"] . "'>" . $rows["BrandName"] . "</option>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
         }
    }
?>