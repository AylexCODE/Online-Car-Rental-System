<?php
    require_once("../../../database/db_conn.php");

    $queryGetLocations = "SELECT * FROM Locations ORDER BY Address";
    
    if(isset($_GET)){
        try{
            $execQueryGetLocations = mysqli_query($conn, $queryGetLocations);
            
            if(mysqli_num_rows($execQueryGetLocations) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetLocations)){
                    echo "<p>" . $rows["Address"] . "<span><img src='./images/icons/xmark.svg' width='12px' height='12px' onclick='deleteConfirmation(&#x27;locations&#x27;,&#x27;" . $rows["Address"]  . "&#x27;)'><img src='./images/icons/edit-icon.svg' width='12px' height='12px'></span></p>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error2 Pre</span>";
         }
    }
?>