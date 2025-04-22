<?php
  require_once("../../../database/db_conn.php");
  
  if(isset($_GET)){
    $uFilterUID = $_POST["uFilterUID"];
    $uName = $_POST["uName"];
    $uEmail = $_POST["uEmail"];
    $uPhoneNo = $_POST["uPhoneNo"];
    $uAge = $_POST["uAge"];
    $uDLicense = $_POST["uDLicense"];
    $uRegDate = $_POST["uRegDate"];
    $uRentTimes = $_POST["uRentTimes"];
    $uPreference = $_POST["uPreference"];

    $getUsersQuery = "SELECT users.UserID, users.Name, users.PhoneNumber, users.Email, DATEDIFF(users.DoB, NOW()) AS Age, users.DriversLicense, users.DateCreated, (SELECT COUNT(rentals.UserID) FROM rentals WHERE users.UserID = rentals.UserID) AS RentTimes, (SELECT brands.BrandName FROM brands INNER JOIN cars WHERE cars.CarID = (SELECT rentals.CarID FROM rentals WHERE rentals.UserID = rentals.UserID GROUP BY rentals.CarID LIMIT 1) LIMIT 1) AS Preference FROM users INNER JOIN rentals;";
    $execGetUsersQuery = mysqli_query($conn, $getUsersQuery);
    
    if(mysqli_num_rows($execGetUsersQuery) != 0){
      while($rows = mysqli_fetch_assoc($execGetUsersQuery)){
        echo "<tr>
                <td>" . $rows["UserID"] . "</td>
                <td>" . $rows["Name"] . "</td>
                <td>" . $rows["Email"] . "</td>
                <td>" . $rows["PhoneNumber"] . "</td>
                <td>" . $rows["Age"] . "</td>
                <td>" . $rows["DriversLicense"] . "</td>
                <td>" . $rows["DateCreated"] . "</td>
                <td>" . $rows["RentTimes"] . "</td>
                <td>" . $rows["Preference"] . "</td>
              </tr>";
      }
    }else{
      echo "<tr><td>No users yet...</td></tr>";
    }
  }
?>