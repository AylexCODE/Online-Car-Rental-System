<?php
    require_once("../../../database/db_conn.php");

    if(isset($_GET)){
        $filterCarName = $_GET["filterCarName"];

        $fCarName = "";
        if($filterCarName != ""){
            $fCarName = "AND cars.CarID = (SELECT CarID FROM cars WHERE cars.BrandID = (SELECT BrandID FROM brands WHERE BrandName LIKE '%" . explode(" ", $filterCarName)[0] . "%' LIMIT 1) LIMIT 1)";
            if(count(explode(" ", $filterCarName)) > 1){
                if(explode(" ", $filterCarName)[1]){
                    $searchModel = str_replace("-", " ", explode(" ", $filterCarName)[1]);
                    $fCarName = "AND cars.CarID = (SELECT CarID FROM cars WHERE cars.BrandID = (SELECT brands.BrandID FROM brands INNER JOIN models WHERE brands.BrandName LIKE '%" . explode(" ", $filterCarName)[0] . "%' AND models.ModelName LIKE '%$searchModel%' LIMIT 1) LIMIT 1)";
                }
            }
        }

        $getCarMaintenance = "SELECT cars.CarID, (SELECT BrandName FROM brands WHERE brands.BrandID = cars.CarID) AS Brand, (SELECT ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, cars.ImageName, damages.Dents, damages.Scratches, damages.ChippedPaint, damages.CrackedWindshields FROM cars INNER JOIN damages ON cars.CarID = damages.CarID WHERE damages.IsDamaged = 1 $fCarName;";
        $count = 0;
        try{
            $execQuery = mysqli_query($conn, $getCarMaintenance);
            if(mysqli_num_rows($execQuery) > 0){
                while($cars = mysqli_fetch_assoc($execQuery)){
                    echo "<span>
                            <img src='./images/cars/" . $cars["ImageName"] . "'>
                            <p>" . $cars["Brand"] . " " . $cars["Model"] . "</p>";
                            echo $cars["Dents"] == 1 ? "<span><input type='checkbox' id='carD$count'><label for='carD$count' style='color: #FF7777;'>&nbsp;Dents</label></span>" : "<span><input type='checkbox' id='carD$count' disabled checked><label for='carD$count'>&nbsp;Dents</label></span>";
                            echo $cars["Scratches"] == 1 ? "<span><input type='checkbox' id='carS$count'><label for='carS$count' style='color: #FF7777;'>&nbsp;Scratches</label></span>" : "<span><input type='checkbox' id='carS$count' disabled checked><label for='carS$count' disabled>&nbsp;Scratches</label></span>";
                            echo $cars["ChippedPaint"] == 1 ? "<span><input type='checkbox' id='carCh$count'><label for='carCh$count' style='color: #FF7777;'>&nbsp;Chipped Paint</label></span>" : "<span><input type='checkbox' id='carCh$count' disabled checked><label for='carCh$count'>&nbsp;Chipped Paint</label></span>";
                            echo $cars["CrackedWindshields"] == 1 ? "<span><input type='checkbox' id='carC$count'><label for='carC$count' style='color: #FF7777;'>&nbsp;Cracked Windshields</label></span>" : "<span><input type='checkbox' id='carC$count' disabled checked><label for='carC$count'>&nbsp;Cracked Windshields</label></span>";
                            echo "<button onclick='fixCar(&#x27;" . $cars["CarID"] . "&#x27;, carD$count.checked, carS$count.checked, carCh$count.checked, carC$count.checked);'>FIX</button>
                        </span>";
                    $count++;
                }
            }else{
                echo ":)";
            }
        }catch(mysqli_sql_exception){}
    }
?>