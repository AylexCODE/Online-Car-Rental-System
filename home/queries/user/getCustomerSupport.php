<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET)){
        $getCusSupportQuery = "SELECT users.UserID, users.Name, users.Email, tickets.Conversation FROM users INNER JOIN tickets ON users.UserID = tickets.UserID;";
        
        try{
            echo "{\"startsof\": \"true\"";
            $execCusSupportQuery = mysqli_query($conn, $getCusSupportQuery);
            while($user = mysqli_fetch_assoc($execCusSupportQuery)){
                echo ",\"user" . $user["UserID"] . "\": {
                                                                 \"id\": \"" . $user["UserID"] . "\",
                                                                 \"name\": \"" .$user["Name"] . "\",
                                                                 \"email\": \"" . $user["Email"] . "\",
                                                                 \"convo\": " . $user["Conversation"] . "
                                                             }";
            }

            echo "}";
        }catch(mysqli_sql_exception){}
    }
?>