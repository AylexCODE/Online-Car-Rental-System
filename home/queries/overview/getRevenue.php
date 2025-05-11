<?php
    require_once("../../../database/db_conn.php");
    
    // Payments status 0 = pending; 1 = Processed; 2 = Cancelled;
    if(isset($_GET)){
        $filter = $_GET["filter"];
        
        if($_GET["type"] == "payments"){
            $getDate = "";
            $groupBy = "";
            if($filter == "month"){
                $getDate = "MONTH(PaymentDate)";
                $groupBy = "GROUP BY Date DESC LIMIT 10";
            }else{
                $getDate = "DATE_FORMAT(PaymentDate, '%m %d, %Y')";
                $groupBy = "GROUP BY Date DESC LIMIT 6";
            }
          
            $query = "SELECT SUM(AmountPaid) AS AmountPaid, $getDate AS Date FROM payments WHERE PaymentStatus = 1 $groupBy;";
            
            try{
                $execQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($execQuery) != 0){
                    $amounts = "";
                    $dates = "";
                    while($rows = mysqli_fetch_assoc($execQuery)){
                        $amounts .= " " . $rows["AmountPaid"];
                        $dates .= "&nbsp;" . $rows["Date"];
                    }
                    
                    echo $amounts . "|" . $dates;
                }else{
                    echo "0 0|0&nbsp;0";
                }
            }catch(mysqli_sql_exception){}
        }elseif($_GET["type"] == "repairs"){
            $getDate = "";
            $groupBy = "";
            if($filter == "month"){
                $getDate = "MONTH(DateAndTime)";
                $groupBy = "GROUP BY Date DESC LIMIT 6";
            }else{
                $getDate = "DATE_FORMAT(DateAndTime, '%m %d, %Y')";
                $groupBy = "GROUP BY Date DESC LIMIT 12";
            }
            
            $query = "SELECT (SUBSTRING_INDEX((SELECT Activity), ' ', -1)) AS FixCost, $getDate AS Date FROM logs WHERE Activity LIKE 'Repaired CarID%' $groupBy;";
            
            try{
                $execQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($execQuery) != 0){
                    $amounts = "";
                    $dates = "";
                    while($rows = mysqli_fetch_assoc($execQuery)){
                        $amounts .= " " . $rows["FixCost"];
                        $dates .= "&nbsp;" . $rows["Date"];
                    }
                    
                    echo $amounts . "|" . $dates;
                }else{
                    echo "0 0|0&nbsp;0";
                }
            }catch(mysqli_sql_exception){}
        }
    }
?>