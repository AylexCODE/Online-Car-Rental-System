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
        try{
            $execQuery = mysqli_query($conn, $getCarMaintenance);
            if(mysqli_num_rows($execQuery) > 0){
                while($cars = mysqli_fetch_assoc($execQuery)){
                    echo "<span>
                            <img src='./images/cars/" . $cars["ImageName"] . "'>
                            <p>" . $cars["Brand"] . " " . $cars["Model"] . "</p>";
                            echo $cars["Dents"] == 1 ? "<span><input type='checkbox' id='carD".$cars["CarID"]."' onchange='setRepairCost(1000, this.checked, ".$cars["CarID"].")'><label for='carD".$cars["CarID"]."' style='color: #FF7777;'>&nbsp;Dents</label></span>" : "<span><input type='checkbox' id='carD".$cars["CarID"]."' disabled checked><label>&nbsp;Dents</label></span>";
                            echo $cars["Scratches"] == 1 ? "<span><input type='checkbox' id='carS".$cars["CarID"]."' onchange='setRepairCost(500, this.checked, ".$cars["CarID"].")'><label for='carS".$cars["CarID"]."' style='color: #FF7777;'>&nbsp;Scratches</label></span>" : "<span><input type='checkbox' id='carS".$cars["CarID"]."' disabled checked><label>&nbsp;Scratches</label></span>";
                            echo $cars["ChippedPaint"] == 1 ? "<span><input type='checkbox' id='carCh".$cars["CarID"]."' onchange='setRepairCost(2500, this.checked, ".$cars["CarID"].")'><label for='carCh".$cars["CarID"]."' style='color: #FF7777;'>&nbsp;Chipped Paint</label></span>" : "<span><input type='checkbox' id='carCh".$cars["CarID"]."' disabled checked><label>&nbsp;Chipped Paint</label></span>";
                            echo $cars["CrackedWindshields"] == 1 ? "<span><input type='checkbox' id='carC".$cars["CarID"]."' onchange='setRepairCost(7549, this.checked, ".$cars["CarID"].")'><label for='carC".$cars["CarID"]."' style='color: #FF7777;'>&nbsp;Cracked Windshields</label></span>" : "<span><input type='checkbox' id='carC".$cars["CarID"]."' disabled checked><label>&nbsp;Cracked Windshields</label></span>";
                            echo "<p style='opacity: 0.7;'>Repair Cost: ₱<span id='repairCost".$cars["CarID"]."'>0</span></p>";
                            echo "<button onclick='fixCar(&#x27;" . $cars["CarID"] . "&#x27;, carD".$cars["CarID"].".checked, carS".$cars["CarID"].".checked, carCh".$cars["CarID"].".checked, carC".$cars["CarID"].".checked);'>FIX</button>
                        </span>";
                }
                echo ":)";
            }
        }catch(mysqli_sql_exception){}
    }
?>