<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_POST)){
        $getPaymentStatsQuery = "SELECT COUNT(PaymentID) AS PaymentCount, SUM(AmountPaid) AS TotalAmt FROM payments;";
        
        $execGetPaymentStatsQuery = mysqli_query($conn, $getPaymentStatsQuery);
        if(mysqli_num_rows($execGetPaymentStatsQuery)){
            $res = mysqli_fetch_assoc($execGetPaymentStatsQuery);

            echo $res["PaymentCount"] . "|" . 0+$res["TotalAmt"];
        }
    }
?>