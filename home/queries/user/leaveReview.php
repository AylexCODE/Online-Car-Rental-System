<?php
    session_start();
    require_once("../../../database/db_conn.php");

    if(isset($_POST)){
        $rentalID = $_POST["rentalID"];
        $carID = $_POST["carId"];
        $rating = $_POST["rating"];
        $userReview = $_POST["userReview"];

        $query = "INSERT INTO reviews VALUE (null, '$rentalID', '" . $_SESSION["UID"] . "', '$carID', '$userReview', '$rating');";
        try{
            mysqli_query($conn, $query);
            echo "<span class='success'>Thank You For Leaving A Review!</span>";
        }catch(mysqli_sql_exception $e){
            echo "Error Pre";
            echo $e;
        }
    }
?>