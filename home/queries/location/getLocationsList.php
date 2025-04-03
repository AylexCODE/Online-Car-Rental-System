<?php
    require_once("../../../database/db_conn.php");

    $queryGetLocations = "SELECT * FROM Locations ORDER BY Address";
    
    if(isset($_GET)){
        try{
            $execQueryGetLocations = mysqli_query($conn, $queryGetLocations);
            
            if(mysqli_num_rows($execQueryGetLocations) != 0){
                while($rows = mysqli_fetch_assoc($execQueryGetLocations)){
                    echo "<p>" . $rows["Address"] . "</p>";
                }
            }
        }catch(mysqli_sql_exception){
            echo "<span class='error'>Error2 Pre</span>";
         }
    }
?>