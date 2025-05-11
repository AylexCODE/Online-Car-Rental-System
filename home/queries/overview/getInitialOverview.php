<?php
    require_once("../../../database/db_conn.php");
    
    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_GET)){
        $type = $_GET["type"];
        
        $getQuery = "";
        if($type == "getBrands"){
            $getQuery = "SELECT COUNT(BrandID) AS Count FROM brands;";
        }elseif($type == "getModels"){
            $getQuery = "SELECT COUNT(ModelID) AS Count FROM models";
        }elseif($type == "getUsers"){
            $getQuery = "SELECT COUNT(UserID) AS Count FROM users";
        }elseif($type == "getActiveRentals"){
            $getQuery = "SELECT COUNT(RentalID) AS Count FROM rentals WHERE Status = 0 OR Status = 1 OR Status = 2;";
        }elseif($type == "getTotalRentals"){
            $getQuery = "SELECT COUNT(RentalID) AS Count FROM rentals WHERE Status = 3;";
        }else{
            $getQuery = "SELECT COUNT(CarID) AS Count FROM cars;";
        }
        
        try{
          $execGetQuery = mysqli_query($conn, $getQuery);
          
          $getResult = mysqli_fetch_assoc($execGetQuery);
          echo $getResult["Count"];
        }catch(mysqli_sql_exception){}
    }
?>