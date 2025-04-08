<?php
  require_once("../../../database/db_conn.php");
  
  if(isset($_GET)){
    $getUsersQuery = "SELECT UserID, Name, PhoneNumber, Email, DoB, DriversLicense FROM users WHERE Role = 'Customer';";
    $execGetUsersQuery = mysqli_query($getUsersQuery);
    
    if(mysqli_num_rows($execGetUsersQuery) != 0){
      while($rows = mysqli_fetch_assoc($execGetUsersQuery)){
        echo "";
      }
    }
  }
?>