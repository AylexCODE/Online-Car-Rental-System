<?php
    require_once("../../../database/db_conn.php");

    $queryGetLocations = "SELECT * FROM locations ORDER BY Address;";
    
    if(isset($_GET)){
        try{
            $execQueryGetLocations = mysqli_query($conn, $queryGetLocations);
            
            if(mysqli_num_rows($execQueryGetLocations) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetLocations)){
                    echo "<p>" . $rows["Address"] . "<span><img src='./images/icons/xmark.svg' width='12px' height='12px' onclick='deleteConfirmation(&#x27;locations&#x27;,&#x27;" . $rows["Address"]  . "&#x27;,&#x27;" . $rows["LocationID"] . "&#x27;); setActiveManagementPane(&#x27;deleteConfirmation&#x27)'><img src='./images/icons/edit-icon.svg' width='12px' height='12px' onclick='editLocationF(&#x27;" . $rows["Address"]  . "&#x27;,&#x27;" . $rows["LocationID"] . "&#x27;); setActiveManagementPane(&#x27;editPaneLocation&#x27)'></span></p>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
         }
    }
?>