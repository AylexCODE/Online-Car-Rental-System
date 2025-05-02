<?php
    require_once("../../database/db_conn.php");

    if(isset($_POST)){
        $getLogsQuery = "SELECT logs.LogID, users.Name, users.Role, logs.DateAndTime, logs.Activity FROM logs INNER JOIN users ON logs.UserID = users.UserID ORDER BY logs.LogID;";

        $execgetLogsQuery = mysqli_query($conn, $getLogsQuery);
        if(mysqli_num_rows($execgetLogsQuery) != 0){
            while($log = mysqli_fetch_assoc($execgetLogsQuery)){
                echo "<tr>
                        <td>" . $logs["LogID"] . "</td>
                        <td>" . $logs["Name"] . "</td>
                        <td>" . $logs["Role"] . "</td>
                        <td>" . $logs["DateAndTime"] . "</td>
                        <td>" . $logs["Activity"] . "</td>
                    </tr>";
            }
        }else{
            echo "<tr><td>No logs yet...</td></tr>";
        }
    }
?>