<?php
    require_once("../../../database/db_conn.php");
    
    $queryGetBrands = "SELECT * FROM brands ORDER BY BrandName";
    
    if(isset($_GET)){
        try{
            $execQueryGetBrands = mysqli_query($conn, $queryGetBrands);
            
            if(mysqli_num_rows($execQueryGetBrands) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetBrands)){
                    // echo "<p>" . $rows["BrandName"] . "<img src='./images/icons/xmark.svg' width='12px' height='12px' onclick='deleteBrands(&#x27;" . $rows["BrandName"] . "&#x27;);'></p>";
                    echo "<p>" . $rows["BrandName"] . "<span><img src='./images/icons/xmark.svg' width='12px' height='12px' onclick='deleteConfirmation(&#x27;brands&#x27;,&#x27;" . $rows["BrandName"] . "&#x27;,&#x27;" . $rows["BrandID"] . "&#x27;); setActiveManagementPane(&#x27;deleteConfirmation&#x27)'><img src='./images/icons/edit-icon.svg' width='12px' height='12px' onclick='editPane(&#x27;" . $rows["BrandName"] . "&#x27;,&#x27;" . $rows["BrandID"] . "&#x27;); setActiveManagementPane(&#x27;editPane&#x27)'></span></p>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error1 Pre</span>";
        }
    }
?>