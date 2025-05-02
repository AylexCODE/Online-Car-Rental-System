<?php
    require_once("../../../database/db_conn.php");
    require_once("../record_logs.php");
    session_start();
    
    if(isset($_POST)){
        $voucherUID = $_POST["voucherUID"];
        $voucherDeduction = $_POST["voucherDeduction"];
        $voucherType = $_POST["voucherType"];
        $voucherExpiryDate = $_POST["voucherExpiryDate"];
        $voucherMaxUsage = $_POST["voucherMaxUsage"];
        
        try{
            $addVoucherQuery = "INSERT INTO vouchers VALUES ('$voucherUID', '$voucherDeduction', '$voucherType', '$voucherExpiryDate', 0, '$voucherMaxUsage');";
            
            mysqli_query($conn, $addVoucherQuery);
            recordLog($_SESSION["userID"], "Added Voucher UID $voucherUID, Discount = $voucherDeduction, Type = $voucherType, Expiry Date = $voucherExpiryDate, And Max Uses = $voucherMaxUsage", $conn);
            echo "<p class='success'>Voucher Added</p>";
        }catch(mysqli_sql_exception $e){
            echo "<p class='error'>Error Pre $e</p>";
        }
    }
?>