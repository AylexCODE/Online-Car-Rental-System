<?php
    require_once("../../../database/db_conn.php");
    
    $queryGetBrands = "SELECT * FROM brands ORDER BY BrandName";
    
    if(isset($_GET)){
        try{
            $execQueryGetBrands = mysqli_query($conn, $queryGetBrands);
            
            if(mysqli_num_rows($execQueryGetBrands) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetBrands)){
                    echo "<p>" . $rows["BrandName"] . "<img src='./images/icons/xmark.svg' width='12px' height='12px' onclick='console.log(&#x27;eee&#x27;);'></p>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error1 Pre</span>";
        }
    }
?>