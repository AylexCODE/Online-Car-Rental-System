<?php
    session_start();
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");

    if(isset($_POST)){
        $rentalID = $_POST["rentalID"];
        $carID = $_POST["carId"];
        $rating = $_POST["rating"];
        $userReview = $_POST["userReview"];

        $query = "INSERT INTO reviews VALUE (null, '$rentalID', '" . $_SESSION["userID"] . "', '$carID', '$userReview', '$rating');";
        try{
            mysqli_query($conn, $query);
            recordLog($_SESSION["userID"], "Left A Review From Rental ID $rentalID", $conn);
            echo "<span class='success'>Thank You For Leaving A Review!</span>";
        }catch(mysqli_sql_exception $e){
            echo "Error Pre";
            echo $e;
        }
    }
?>