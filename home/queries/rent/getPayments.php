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

        $filterPaymentID = "";
        $filterPaymentRentID = "";
        $filterPaymentName = "";
        $filterPaymentPaid = "";
        $filterPaymentMethod = "";
        $filterPaymentFreq = "";
        $filterPaymentDate = "";
        $filterPaymentVoucherID = "";
        if($filterPayId != ""){
            $filterPaymentID = " > 0";
        }
        if($filterPayRentID != ""){
            $filterPaymentRentID = "AND = $filterPayRentID";
        }
        if($filterPayName != ""){
            $filterPaymentName = "AND LIKE '%$filterPayName%'"; // Not Sure!
        }
        if($filterPayPaid != ""){
            $filterPaymentPaid = "AND LIKE'%$filterPayPaid%'";
        }
        if($filterPayMethod != ""){
            $filterPaymentMethod = "AND = '$filterPayMethod'";
        }
        if($filterPayFreq != ""){
            $filterPaymentFreq = "AND = '$filterPayFreq'";
        }
        if($filterPayDate != ""){
            $filterPaymentDate = "AND = '$filterPayDate'";
        }
        if($filterPayVoucherID != ""){
            $filterPaymentVoucherID = "AND LIKE '%$filterPayVoucherID%'";
        }

        try{
        }catch(mysqli_sql_exception){
            echo "Error Pre";
        }
    }
?>