<?php
    require_once("../../../database/db_conn.php");
    
    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_GET)){
        $filter = $_GET["filter"];
        
        $getDate = "";
        $groupBy = "";
        if($filter == "month"){
            $getDate = "MONTH(StartDate)";
            $groupBy = "GROUP BY Date DESC LIMIT 10";
        }else{
            $getDate = "DATE_FORMAT(StartDate, '%m %d, %Y')";
            $groupBy = "GROUP BY Date DESC LIMIT 6";
        }
        
        try{
            $query = "SELECT COUNT(RentalID) AS RentalsCount, $getDate AS Date FROM rentals WHERE Status != 4 OR Status != 5 $groupBy;";
            $execQuery = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($execQuery) != 0){
                $rentalCounts = "";
                $dates = "";
                while($rows = mysqli_fetch_assoc($execQuery)){
                    $rentalCounts .= " " . $rows["RentalsCount"];
                    $dates .= "&nbsp;" . $rows["Date"];
                }
                
                echo $rentalCounts . "|" . $dates;
            }else{
                echo "0 0|0&nbsp;0";
            }
        }catch(mysqli_sql_exception){}
    }
?>