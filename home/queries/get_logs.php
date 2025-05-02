<?php
    require_once("../../database/db_conn.php");

    if(isset($_POST)){
        $logsFilterNo = $_POST["logsFilterNo"];
        $logsFilterUser = $_POST["logsFilterUser"];
        $logsFilterRole = $_POST["logsFilterRole"];
        $logsFilterDate = $_POST["logsFilterDate"];
        $logsFilterActivity = $_POST["logsFilterActivity"];
        
        $logFilterNo = "logs.LogID > 0";
        $logFilterUser = "";
        $logFilterRole = "";
        $logFilterDate = "";
        $logFilterActivity = "";
        if($logsFilterNo != ""){
            $logFilterNo = "logs.LogID LIKE '%$logsFilterNo%'";
        }
        if($logsFilterUser != ""){
            $logFilterUser = "AND logs.UserID = (SELECT UserID FROM users WHERE Name LIKE '%$logsFilterUser%')";
        }
        if($logsFilterRole != ""){
            $logFilterRole = "AND users.Role = '$logsFilterRole'";
        }
        if($logsFilterDate != ""){
            $logFilterDate = "AND logs.DateAndTime >= '$logsFilterDate'";
        }
        if($logsFilterActivity != ""){
            $logFilterActivity = "AND logs.Activity LIKE '%$logsFilterActivity%'";
        }
      
        $getLogsQuery = "SELECT logs.LogID, users.Name, users.Role, logs.DateAndTime, logs.Activity FROM logs INNER JOIN users ON logs.UserID = users.UserID WHERE $logFilterNo $logFilterUser $logFilterRole $logFilterDate $logFilterActivity ORDER BY logs.LogID DESC;";

        try{
            $execgetLogsQuery = mysqli_query($conn, $getLogsQuery);
            if(mysqli_num_rows($execgetLogsQuery) != 0){
                while($log = mysqli_fetch_assoc($execgetLogsQuery)){
                    echo "<tr>
                            <td>" . $log["LogID"] . "</td>
                            <td>" . $log["Name"] . "</td>
                            <td>" . $log["Role"] . "</td>
                            <td>" . $log["DateAndTime"] . "</td>
                            <td>" . $log["Activity"] . "</td>
                        </tr>";
                }
            }else{
                echo "<tr><td>No logs yet...</td></tr>";
            }
        }catch(mysqli_sql_exception $error){
            if(str_contains($error, "returns more than 1 row")){
                echo "<tr><td></td><td>Be specific</td></tr>";
            }
        }
    }
?>