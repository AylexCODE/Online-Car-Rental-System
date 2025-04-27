<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_POST)){
        $voucherUID = $_POST["voucherUID"];
        $voucherDeduction = $_POST["voucherDeduction"];
        $voucherType = $_POST["voucherType"];
        $voucherExpiryDate = $_POST["voucherExpiryDate"];
        $voucherMaxUsage = $_POST["voucherMaxUsage"];
        
        try{
            $addVoucherQuery = "INSERT INTO vouchers VALUES ('$voucherUID', '$voucherDeduction', '$voucherType', '$voucherExpiryDate', 0, '$voucherMaxUsage');";
            
            mysqli_query($conn, $addVoucherQuery);
            echo "<p class='success'>Voucher Added</p>";
        }catch(mysqli_sql_exception $e){
            echo "<p class='error'>Error Pre $e</p>";
        }
    }
?>