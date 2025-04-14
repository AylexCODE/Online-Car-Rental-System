<?php
    require_once("../../../database/db_conn.php");

    $queryGetLocation = "SELECT * FROM Locations ORDER BY Address";
    
    if(isset($_GET)){
        try{
            $execQueryGetLocations = mysqli_query($conn, $queryGetLocation);
            
            if(mysqli_num_rows($execQueryGetLocations) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetLocations)){
                    if($rows["AddressCode"] == "PXW6+572, Provincial Road, Balilihan, Bohol, Philippines"){
                        echo "<option value='" . $rows["LocationID"] . "|" . $rows["Address"] . "|" . $rows["AddressCode"] . "|" . $rows["DistanceKM"] . "' selected>" . $rows["Address"] . "</option>";
                    }else{
                        echo "<option value='" . $rows["LocationID"] . "|" . $rows["Address"] . "|" . $rows["AddressCode"] . "|" . $rows["DistanceKM"] . "'>" . $rows["Address"] . "</option>";
                    }
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error Pre</span>";
         }
    }
?>