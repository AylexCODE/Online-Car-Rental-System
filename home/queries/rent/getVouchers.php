<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET)){
        $getVouchersQuery = "";
      
        if($_GET["m"] == "getAll"){
            $getVouchersQuery = "SELECT * FROM vouchers";
        }elseif($_GET["m"] == "getActive"){
            $getVouchersQuery = "SELECT * FROM vouchers WHERE DATEDIFF(ExpiryDate, NOW()) >= 0 OR UsedTimes < MaxUsage;";
        }elseif($_GET["m"] == "getUsed"){
            $getVouchersQuery = "SELECT * FROM vouchers WHERE DATEDIFF(ExpiryDate, NOW()) < 0 OR UsedTimes = MaxUsage;";
        }elseif($_GET["m"] == "getCountAll"){
            $getVouchersQuery = "SELECT Count(VoucherID) AS VCount FROM vouchers;";
        }elseif($_GET["m"] == "getCountActive"){
            $getVouchersQuery = "SELECT Count(VoucherID) AS VCount FROM vouchers WHERE DATEDIFF(ExpiryDate, NOW()) >= 0 OR UsedTimes < MaxUsage;";
        }elseif($_GET["m"] == "getCountUsed"){
            $getVouchersQuery = "SELECT Count(VoucherID) AS VCount FROM vouchers WHERE DATEDIFF(ExpiryDate, NOW()) < 0 OR UsedTimes = MaxUsage;";
        }
        
        try{
            $execGetVouchersQuery = mysqli_query($conn, $getVouchersQuery);
            
            if(mysqli_num_rows($execGetVouchersQuery) > 0){
                while($voucher = mysqli_fetch_assoc($execGetVouchersQuery)){
                    switch($_GET["m"]){
                        case "getCountAll":
                        case "getCountActive":
                        case "getCountUsed":
                            echo $voucher["VCount"];
                            break;
                        default:
                            echo "<tr><td>" . $voucher["VoucherID"] . "</td>
                                <td>" . $voucher["Discount"] . "</td>
                                <td>" . explode(' ', $voucher["ExpiryDate"])[0] . "</td>
                                <td>" . $voucher["UsedTimes"] . "</td>
                                <td>" . $voucher["MaxUsage"] . "</td></tr>";
                    }
                }
            }else{
                echo "<tr><td>No Vouchers Yet...</td></tr>";
            }
        }catch(mysqli_sql_exception){
            echo "<td>Error</td>";
        }
    }
?>