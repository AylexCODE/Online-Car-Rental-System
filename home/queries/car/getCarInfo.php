<?php
    require_once("../../../database/db_conn.php");

    if(isset($_GET)){
        $name = $_GET["name"];

        $getCarInfoQuery = "SELECT CONCAT((SELECT BrandName FROM brands WHERE brands.BrandID = cars.BrandID), ' ', (SELECT ModelName WHERE models.ModelID = cars.ModelID)) AS Data FROM cars INNER JOIN models ON cars.ModelID = models.ModelID ORDER BY Data";
        if($name == "ALL MODELS"){
            $getCarInfoQuery = "SELECT ModelName AS Data FROM models;";
        }elseif($name == "ALL BRANDS"){
            $getCarInfoQuery = "SELECT BrandName AS Data FROM brands;";
        }elseif($name == "GetModelCount"){
            $getCarInfoQuery = "SELECT COUNT(ModelID) AS Data FROM models;";
        }elseif($name == "GetBrandCount"){
            $getCarInfoQuery = "SELECT COUNT(BrandID) AS Data FROM brands;";
        }elseif($name == "GetCarCount"){
            $getCarInfoQuery = "SELECT COUNT(CarID) AS Data FROM cars;";
        }elseif($name == "maintenance"){
            $getCarInfoQuery = "SELECT COUNT(CarID) AS Data FROM damages WHERE isDamaged = 1;";
        }

        try{
            $execGetCarInfo = mysqli_query($conn, $getCarInfoQuery);
            if(mysqli_num_rows($execGetCarInfo) > 0){
                while($rows = mysqli_fetch_assoc($execGetCarInfo)){
                    echo $rows["Data"];
                }
            }else{
                echo "<p>No data yet...</p>";
            }
        }catch(mysqli_sql_exception $e){echo $e;}
    }