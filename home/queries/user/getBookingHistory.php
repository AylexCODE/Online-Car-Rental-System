<?php
    session_start();

    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = ongoing; 2 = completed; 3 = cancelled
    if(isset($_GET)){
      $getBookingHistoryQuery = "SELECT (SELECT (SELECT BrandName FROM brands WHERE BrandID = cars.BrandID) AS Brand FROM cars WHERE CarID = rental.CarID) AS Brand, (SELECT (SELECT ModelName FROM models where ModelID = cars.ModelID) AS Model FROM cars WHERE CarID = rental.CarID) AS Model, rental.StartDate, rental.EndDate, rental.Status, DATEDIFF(rental.EndDate, rental.StartDate) AS Duration, payment.AmountPaid, payment.PaymentFrequency, rental.status FROM rentals rental INNER JOIN payments payment ON rental.RentalID = payment.RentalID WHERE UserID = '" . $_SESSION["UID"] . "';";
      $execGetBookingHistoryQuery = mysqli_query($conn, $getBookingHistoryQuery);
      
      $i = 1;
      if(mysqli_num_rows($execGetBookingHistoryQuery) != 0){
        while($rows = mysqli_fetch_assoc($execGetBookingHistoryQuery)){
            echo "<tr>
                <td>$i</td>
                <td>" . $rows["Brand"] . "&nbsp;" . $rows["Model"] . "</td>
                <td>" . $rows["StartDate"] . "</td>
                <td>" . $rows["EndDate"] . "</td>
                <td>"; echo $rows["Duration"] == 1 ? $rows["Duration"] . "Day" : $rows["Duration"] . "Days"; echo"</td>
                <td>" . $rows["AmountPaid"] . "</td>
                <td>" . $rows["PaymentFrequency"] . "</td>
                <td>" . $rows["status"] . "</th>
            </tr>";
            $i++;
        }
      }
    }
?>