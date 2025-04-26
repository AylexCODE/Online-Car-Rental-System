<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_POST)){
        $filterPayId = $_POST["filterPayId"];
        $filterPayRentID = $_POST["filterPayRentID"];
        $filterPayName = $_POST["filterPayName"];
        $filterPayPaid = $_POST["filterPayPaid"];
        $filterPayMethod = $_POST["filterPayMethod"];
        $filterPayFreq = $_POST["filterPayFreq"];
        $filterPayDate = $_POST["filterPayDate"];
        $filterPayVoucherID = $_POST["filterPayVoucherID"];

        $filterPaymentID = "payments.PaymentID > 0";
        $filterPaymentRentID = "";
        $filterPaymentName = "";
        $filterPaymentPaid = "";
        $filterPaymentMethod = "";
        $filterPaymentFreq = "";
        $filterPaymentDate = "";
        $filterPaymentVoucherID = "";
        if($filterPayId != ""){
            $filterPaymentID = "payments.PaymentID LIKE '%$filterPayId'";
        }
        if($filterPayRentID != ""){
            $filterPaymentRentID = "AND payments.RentalID = $filterPayRentID";
        }
        if($filterPayName != ""){
           // $filterPaymentName = "AND LIKE '%$filterPayName%'"; // Not Sure!
        }
        if($filterPayPaid != ""){
            $filterPaymentPaid = "AND payments.AmountPaid LIKE'%$filterPayPaid%'";
        }
        if($filterPayMethod != ""){
            if($filterPayMethod != "All"){
                $filterPaymentMethod = "AND payments.PaymentMethod = '$filterPayMethod'";
            }
        }
        if($filterPayFreq != ""){
            if($filterPayFreq != "All"){
                $filterPaymentFreq = "AND payments.PaymentFrequency = '$filterPayFreq'";
            }
        }
        if($filterPayDate != ""){
            $filterPaymentDate = "AND payments.PaymentDate = '$filterPayDate'";
        }
        if($filterPayVoucherID != ""){
            $filterPaymentVoucherID = "AND payments.VoucherID LIKE '%$filterPayVoucherID%'";
        }

        try{
            $getPaymentsQuery = "SELECT payments.PaymentID, payments.RentalID, payments.AmountPaid, payments.PaymentMethod, payments.PaymentFrequency, payments.PaymentDate, payments.VoucherID FROM payments WHERE $filterPaymentID $filterPaymentRentID $filterPaymentName $filterPaymentPaid $filterPaymentMethod $filterPaymentFreq $filterPaymentDate $filterPaymentVoucherID";
            
            $execGetPayments = mysqli_query($conn, $getPaymentsQuery);
            if(mysqli_num_rows($execGetPayments) > 0){
                while($rows = mysqli_fetch_assoc($execGetPayments)){
                    echo "<td>" . $rows["PaymentID"] . "</td>
                          <td>" . $rows["RentalID"] . "</td>
                          <td>" . $rows["RentalID"] . "</td>
                          <td>" . $rows["AmountPaid"] . "</td>
                          <td>" . $rows["PaymentMethod"] . "</td>
                          <td>" . $rows["PaymentFrequency"] . "</td>
                          <td>" . $rows["PaymentDate"] . "</td>
                          <td>" . $rows["VoucherID"] . "</td>";
                }
            }else{
                echo "<td>No Data<td>";
            }
        }catch(mysqli_sql_exception $e){
            echo "Error Pre";
            echo $e;
        }
    }
?>