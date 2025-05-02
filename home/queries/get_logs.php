<?php
    require_once("../../database/db_conn.php");

    if(isset($_POST)){
        $getLogsQuery = "SELECT logs.LogID, users.Name, users.Role, logs.DateAndTime, logs.Activity FROM logs INNER JOIN users ON logs.UserID = users.UserID ORDER BY logs.LogID DESC;";

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
    }
?>