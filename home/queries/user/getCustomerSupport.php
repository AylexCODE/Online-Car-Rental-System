<?php
    require_once("../../../database/db_conn.php");
    
    if(isset($_GET)){
        $tFilterName = $_GET["name"];
        $tUserFilterSort = $_GET["sort"];

        $filterName = "tickets.TicketID > 0";
        $filterSort = "users.Name";
        if($tFilterName != ""){
            $filterName = "users.Name LIKE '%$tFilterName%'";
        }
        if($tUserFilterSort != "Alphabet"){
            $filterSort = "tickets.Date $tUserFilterSort";
        }

        $getCusSupportQuery = "SELECT users.UserID, users.Name, users.Email, tickets.Conversation FROM users INNER JOIN tickets ON users.UserID = tickets.UserID WHERE $filterName ORDER BY $filterSort;";
        //echo $getCusSupportQuery;
        try{
            $execCusSupportQuery = mysqli_query($conn, $getCusSupportQuery);
            echo "{\"startsof\": \"true\"";
            
            if(mysqli_num_rows($execCusSupportQuery)){
                while($user = mysqli_fetch_assoc($execCusSupportQuery)){
                    echo ",\"user" . $user["UserID"] . "\": {
                                                                    \"id\": \"" . $user["UserID"] . "\",
                                                                    \"name\": \"" .$user["Name"] . "\",
                                                                    \"email\": \"" . $user["Email"] . "\",
                                                                    \"convo\": " . $user["Conversation"] . "
                                                                }";
                }

            }else{
                echo ",\"user\": {
                    \"id\": \"Na\",
                    \"name\": \"Na\",
                    \"email\": \"Na\",
                    \"convo\": \"Na\",
                    \"noresult\": \"yes\"
                }";
            }
            echo "}";
        }catch(mysqli_sql_exception){}
    }
?>