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
    $uOrderBy = $_POST["uOrderBy"];
    $uSortOrder = $_POST["uSortOrder"];

    $filterUID = "users.UserID >= 0";
    $filterName = "";
    $filterEmail = "";
    $filterPhoneNo = "";
    $filterAge = "";
    $filterDLicense = "";
    $filterRegDate = "";
    $filterRentTimes = "";
    if($uFilterUID != ""){
      $filterUID = "users.UserID = $uFilterUID";
    }
    if($uName != ""){
        $filterName = "AND users.Name LIKE '%$uName%'";
    }
    if($uEmail != ""){
        $filterEmail = "AND users.Email LIKE '$uEmail%'";
    }
    if($uPhoneNo != ""){
        $filterPhoneNo = "AND users.PhoneNumber LIKE '$uPhoneNo%'"; 
    }
    if($uAge != ""){
        $filterAge = "AND TIMESTAMPDIFF(YEAR, users.DoB, NOW()) = $uAge";
    }
    if($uDLicense != ""){
        $filterDLicense = "AND users.DriversLicense LIKE '%$uDLicense%'";   
    }
    if($uRegDate != ""){
        $filterRegDate = "AND DATEDIFF(users.DateCreated, '$uRegDate') = 0"; 
    }
    if($uRentTimes != ""){
        $filterRentTimes = "AND (SELECT COUNT(rentals.UserID) FROM rentals WHERE users.UserID = rentals.UserID) >= $uRentTimes";  
    }

    switch($uSortOrder){
        case "UID":
            $uSortOrder = "users.UserID";
            break;
        case "Name":
            $uSortOrder = "users.Name";
            break;
        case "Email":
            $uSortOrder = "users.Email";
            break;
        case "Age":
            $uSortOrder = "Age";
            break;
        case "RegDate":
            $uSortOrder = "users.DateCreated";
            break;
        case "Rents":
            $uSortOrder = "RentTimes";
            break;
    }

    $sortOrder = "ORDER BY $uSortOrder" . " $uOrderBy";

    $getUsersQuery = "SELECT DISTINCT users.UserID, users.Name, users.PhoneNumber, users.Email, TIMESTAMPDIFF(YEAR, users.DoB, NOW()) AS Age, users.DriversLicense, users.DateCreated, (SELECT COUNT(rentals.UserID) FROM rentals WHERE users.UserID = rentals.UserID) AS RentTimes FROM users LEFT JOIN rentals ON users.UserID = rentals.UserID WHERE $filterUID $filterName $filterEmail $filterPhoneNo $filterAge $filterDLicense $filterRegDate $filterRentTimes $sortOrder;";
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
                <td>" . $rows["RentTimes"] . "</td>";
        if($rows["RentTimes"] != 0) {
            $preferred = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(CarID) AS CarCOUNT, (SELECT BrandName FROM brands WHERE BrandID = (SELECT cars.BrandID FROM cars WHERE CarID = rentals.CarID)) AS Preferred FROM rentals WHERE UserID = 2 GROUP BY CarID ORDER BY CarCOUNT DESC LIMIT 1;"));
            echo "<td>" . $preferred["Preferred"] . "</td>";
        }else{
            echo "<td>NA</td>";
        }
              echo "</tr>";
      }
    }else{
      echo "<tr><td>No users yet...</td></tr>";
    }
  }
?>