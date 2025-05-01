<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET)){
        $userID = $_GET["userid"];
        
        $getMessagesQuery = "SELECT Conversation, Status FROM tickets WHERE UserID = '" . $userID ."';";
        try{
            $execGetMessages = mysqli_query($conn, $getMessagesQuery);
            $getConvo = mysqli_fetch_assoc($execGetMessages);
            
            if(mysqli_num_rows($execGetMessages) != 0){
                echo $getConvo["Conversation"];
            }else{}
        }catch(mysqli_sql_exception){}
    }
?>