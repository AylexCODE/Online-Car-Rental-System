<?php
    session_start();
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");

    if(isset($_POST)){
        $carID = $_POST["carID"];
        $repairCost = $_POST["repairCost"];
        $dents = $_POST["dents"];
        $scratches = $_POST["scratches"];
        $chippedPaint = $_POST["chippedPaint"];
        $crackedWindshields = $_POST["crackedWindshields"];
        $isDamaged = 1;

        if($dents == 0 && $scratches == 0 && $chippedPaint == 0 && $crackedWindshields == 0){
            $isDamaged = 0;
        }

        $getAccumulatedCost = "SELECT AccumulatedCost FROM damages WHERE CarID = '$carID';";
        try{
            $execAccumulatedCostQuery = mysqli_query($conn, $getAccumulatedCost);
            $accumulatedCost = mysqli_fetch_assoc($execAccumulatedCostQuery);
            
            try{
                $setCarDamages = "UPDATE damages SET isDamaged = '$isDamaged', Dents = '$dents', Scratches = '$scratches', ChippedPaint = '$chippedPaint', CrackedWindshields = '$crackedWindshields', AccumulatedCost = " . intval($accumulatedCost["AccumulatedCost"])+intval($repairCost) . " WHERE CarID = '$carID';";
                mysqli_query($conn, $setCarDamages);
                
                recordLog($_SESSION["userID"], "Repaired CarID $carID COST ₱$repairCost", $conn);
            }catch(mysqli_sql_exception){}
        }catch(mysqli_sql_exception $e){echo $e;}
    }
?>