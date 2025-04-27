<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET["VoucherUID"])){
        $VoucherUID = $_GET["VoucherUID"];
        
        try {
            $checkVQuery = "SELECT Discount, UsedTimes, MaxUsage, Type, DATEDIFF(ExpiryDate, NOW()) AS IsExpired FROM vouchers WHERE VoucherUID = '$VoucherUID';";
            
            $execCheckVQuery = mysqli_query($conn, $checkVQuery);
            if(mysqli_num_rows($execCheckVQuery) > 0){
                $voucherStats = mysqli_fetch_assoc($execCheckVQuery);
                if($voucherStats["UsedTimes"] == $voucherStats["MaxUsage"]){
                    echo "limitreached";
                }elseif($voucherStats["IsExpired"] < 0){
                    echo "expired";
                }else{
                    if($voucherStats["Type"] == "Cash"){
                        echo "(Saved ₱" . $voucherStats["Discount"] . ")";
                    }else{
                        echo "(Saved " . $voucherStats["Discount"] . "%)";
                    }
                }
            }else{
                echo "invalid";
            }
        }catch(mysqli_sql_exception){
            echo "Error";
        }
    }
?>