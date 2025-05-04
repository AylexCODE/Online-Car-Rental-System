<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $recentFilterId = $_POST["recentFilterId"];
        $recentFilterBrandModel = $_POST["recentFilterBrandModel"];
        $recentFilterName = $_POST["recentFilterName"];
        $recentFilterEmail = $_POST["recentFilterEmail"];
        $recentFilterDate = $_POST["recentFilterDate"];
        $recentFilterType = $_POST["recentFilterType"];
        $recentFilterDmg = $_POST["recentFilterDmg"];  
        
        $rFilterId = "statistics.StatisticsID > 0";
        $rFilterBrandModel = "";
        $rFilterName = "";
        $rFilterEmail = "";
        $rFilterDate = "";
        $rFilterType = "";
        $rFilterDmg = "";

        if($recentFilterId != ""){
            $rFilterId = "statistics.StatisticsID LIKE '%$recentFilterId%'";
        }
        if($recentFilterBrandModel != ""){
            $rFilterBrandModel = "AND statistics.CarID = (SELECT CarID FROM cars WHERE cars.BrandID = (SELECT BrandID FROM brands WHERE BrandName LIKE '%" . explode(" ", $recentFilterBrandModel)[0] . "%' LIMIT 1) LIMIT 1)";
            if(count(explode(" ", $recentFilterBrandModel)) > 1){
                if(explode(" ", $recentFilterBrandModel)[1]){
                    $searchModel = str_replace("-", " ", explode(" ", $recentFilterBrandModel)[1]);
                    $rFilterBrandModel = "AND statistics.CarID = (SELECT CarID FROM cars WHERE cars.BrandID = (SELECT brands.BrandID FROM brands INNER JOIN models WHERE brands.BrandName LIKE '%" . explode(" ", $recentFilterBrandModel)[0] . "%' AND models.ModelName LIKE '%$searchModel%' LIMIT 1) LIMIT 1)";
                }
            }
        }
        if($recentFilterName != ""){
            $rFilterName = "AND statistics.CustomerID = (SELECT UserID FROM users WHERE Name LIKE '%$recentFilterName%');";
        }
        if($recentFilterEmail != ""){
            $rFilterEmail = "AND statistics.CustomerID = (SELECT UserID FROM users WHERE Email LIKE '%$recentFilterEmail%');";
        }
        if($recentFilterDate != ""){
            $rFilterDate = "AND statistics.DateTime >= '$recentFilterDate'";
        }
        if($recentFilterType != "All"){
            $rFilterType = "AND statistics.Type = '$recentFilterType'";
        }
        if($recentFilterDmg != "All"){
            if($recentFilterDmg == "No"){
                $rFilterDmg = "AND statistics.Damages = ''";
            }else{
                $rFilterDmg = "AND statistics.Damages != ''";
            }
        }

        $getCarStatsQuery = "SELECT statistics.StatisticsID, (SELECT BrandName FROM brands WHERE brands.BrandID = cars.BrandID) AS Brand, (SELECT ModelName FROM models WHERE models.ModelID = cars.ModelID) AS Model, (SELECT Name FROM users WHERE users.UserID = statistics.CustomerID) AS Name, (SELECT Email FROM users WHERE users.UserID = statistics.CustomerID) AS Email, statistics.DateTime, statistics.Type, statistics.Damages FROM car_statistics statistics INNER JOIN cars ON statistics.CarID = cars.CarID WHERE $rFilterId $rFilterBrandModel $rFilterName $rFilterEmail $rFilterDate $rFilterType $rFilterDmg";

        try{
            $execGetCarStatsQuery = mysqli_query($conn, $getCarStatsQuery);
            if(mysqli_num_rows($execGetCarStatsQuery)){
                while($rows = mysqli_fetch_assoc($execGetCarStatsQuery)){
                    echo "<tr>
                            <td>" . $rows["StatisticsID"] . "</td>
                            <td>" . $rows["Brand"] . " " . $rows["Model"] . "</td>
                            <td>" . $rows["Name"] . "</td>
                            <td>" . $rows["Email"] . "</td>
                            <td>" . $rows["DateTime"] . "</td>
                            <td>" . $rows["Type"] . "</td>
                            <td>" . $rows["Damages"] . "</td>
                        </tr>";
                }
            }else{

            }
        }catch(mysqli_sql_exception $e) {
            if(str_contains($e, "returns more than 1 row")){
                echo "<tr><td></td><td></td><td>Be specific...</td></tr>";
            }
        }
    }
?>