<?php
    require_once("../database/db_conn.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $query = "UPDATE users SET Role = 'Admin' WHERE UserID = $id";
        try{
            mysqli_query($conn, $query);
        }catch(mysqli_sql_exception $e){
        }finally{
            header("location: ../home/index.php");
        }
    }
?>