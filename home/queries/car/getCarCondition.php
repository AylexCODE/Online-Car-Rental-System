<?php
    require_once("../../../database/db_conn.php");
        
    if(isset($_POST)){
        $carID = $_POST["carID"];

        $getConditionQuery = "SELECT isDamaged, Dents, Scratches, ChippedPaint, CrackedWindshields   FROM damages WHERE CarID = '$carID';";
        try{
            $execQuery = mysqli_query($conn, $getConditionQuery);
            $damages = mysqli_fetch_assoc($execQuery);

            if($damages["isDamaged"] == 0){
                echo "<p>No Damages</p>";
            }else{
                echo "<p style='font-size: 20px; border-bottom: 1px solid #FDFFF6;'>Damages</p>
                    <p>Dents: " . ($damages["Dents"] == 1 ? "<span style='color: #e27c00;'>Damaged</span>" : "None") . "</p>
                    <p>Scratches: " . ($damages["Scratches"] == 1 ? "<span style='color: #e27c00;'>Damaged</span>" : "None") . "</p>
                    <p>Chipped Paint: " . ($damages["ChippedPaint"] == 1 ? "<span style='color: #e27c00;'>Damaged</span>" : "None") . "</p>
                    <p>Cracked Windshields: " . ($damages["CrackedWindshields"] == 1 ? "<span style='color: #e27c00;'>Damaged</span>" : "None") . "</p>
                    <button style='position: relative; left: 50%; transform: translateX(-50%); background-color: #316C40; color: #E2F87B; border: 1px solid #E2F87B;'>Request Repair</p>";
            }
        }catch(mysqli_sql_exception){
            echo "Error";
        }
    }
?>