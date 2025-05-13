<?php
    require_once("../../database/db_conn.php");

    if(isset($_POST)){
        if($_POST["type"] == "backup"){
            $query = "COMMIT;";
        }else if($_POST["type"] == "start"){
            $query = "START TRANSACTION;";
        }else{
            $query = "ROLLBACK";
        }
        
        try{
            mysqli_query($conn, $query);
            echo "Ok";
        }catch(mysqli_sql_exception $e){echo $e;}
    }
?>