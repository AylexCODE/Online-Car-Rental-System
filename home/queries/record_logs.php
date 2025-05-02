<?php
    function recordLog($userID, $activity, $conn){
        $recordLogsQuery = "INSERT INTO logs VALUES (null, '$userID', NOW(), '$activity')";
        try{
            mysqli_query($conn, $recordLogsQuery);
        }catch(mysqli_sql_exception){}
    }
?>