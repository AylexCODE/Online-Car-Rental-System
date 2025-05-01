<?php
    session_start();
    require_once("../../../database/db_conn.php");

    // Ticket Status: 0 = Open, 1 = Closed, 2 = Resolved
    if(isset($_POST)){
        $data = $_POST["ddata"];
        
        $checkUserMessageQuery = "SELECT * FROM tickets WHERE UserID = '" . $_SESSION["userID"] . "';";
        
        try{
            $userMsgExist = mysqli_query($conn, $checkUserMessageQuery);
            if(mysqli_num_rows($userMsgExist) != 0){
                $sendMessageQuery = "UPDATE tickets SET Conversation = '" . $data . "'";
                mysqli_query($conn, $sendMessageQuery);
            }else{
                $sendMessageQuery = "INSERT INTO tickets VALUES (null, '". $_SESSION["userID"] . "', '$data', 0)";
                mysqli_query($conn, $sendMessageQuery);
            }
        }catch(mysqli_sql_exception){}
    }
?>