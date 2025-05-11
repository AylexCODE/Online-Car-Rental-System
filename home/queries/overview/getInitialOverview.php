<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET)){
        $type = $_GET["type"];
        
        $getQuery = "";
        if($type == "getBrands"){
            $getQuery = "SELECT COUNT(BrandID) AS Count FROM brands;";
        }elseif($type == "getModels"){
            $getQuery = "SELECT COUNT(ModelID) AS Count FROM models";
        }elseif($type == "getUsers"){
            $getQuery = "SELECT COUNT(UserID) AS Count FROM users";
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