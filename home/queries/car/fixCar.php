<?php
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $carID = $_POST["carID"];
        $dents = $_POST["dents"];
        $scratches = $_POST["scratches"];
        $chippedPaint = $_POST["chippedPaint"];
        $crackedWindshields = $_POST["crackedWindshields"];
        $isDamaged = 1;

        if($dents == 0 && $scratches == 0 && $chippedPaint == 0 && $crackedWindshields == 0){
            $isDamaged = 0;
        }

        $setCarDamages = "UPDATE damages SET isDamaged = '$isDamaged', Dents = '$dents', Scratches = '$scratches', ChippedPaint = '$chippedPaint', CrackedWindshields = '$crackedWindshields' WHERE CarID = '$carID';";
        try{
            mysqli_query($conn, $setCarDamages);
            echo "EY";
        }catch(mysqli_sql_exception $e){echo $e;}
    }
?>