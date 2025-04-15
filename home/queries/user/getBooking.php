<?php
    session_start();

    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = ongoing; 2 = completed; 3 = cancelled
    if(isset($_GET)){
      if($_POST["action"] == "getHistory"){
        $getBookingHistoryQuery = "SELECT (SELECT (SELECT BrandName FROM brands WHERE BrandID = cars.BrandID) AS Brand FROM cars WHERE CarID = rental.CarID) AS Brand, (SELECT (SELECT ModelName FROM models where ModelID = cars.ModelID) AS Model FROM cars WHERE CarID = rental.CarID) AS Model, rental.StartDate, rental.EndDate, rental.Status, DATEDIFF(rental.EndDate, rental.StartDate) AS Duration, payment.AmountPaid, payment.PaymentFrequency, rental.status FROM rentals rental INNER JOIN payments payment ON rental.RentalID = payment.RentalID WHERE UserID = '" . $_SESSION["UID"] . "' ORDER BY rental.RentalID DESC;";
        $execGetBookingHistoryQuery = mysqli_query($conn, $getBookingHistoryQuery);
        
        $i = 1;
        if(mysqli_num_rows($execGetBookingHistoryQuery) != 0){
          while($rows = mysqli_fetch_assoc($execGetBookingHistoryQuery)){
              echo "<tr>
                  <td>$i</td>
                  <td>" . $rows["Brand"] . "&nbsp;" . $rows["Model"] . "</td>
                  <td>" . $rows["StartDate"] . "</td>
                  <td>" . $rows["EndDate"] . "</td>
                  <td>"; echo $rows["Duration"] == 1 ? $rows["Duration"] . "&nbsp;Day" : $rows["Duration"] . "&nbsp;Days"; echo"</td>
                  <td>" . $rows["AmountPaid"] . "</td>
                  <td>" . $rows["PaymentFrequency"] . "</td>
                  <td>" . $rows["status"] . "</th>
              </tr>";
              $i++;
          }
        }
      }elseif($_POST["action"] == "getCar"){
        $getBookingCar = "SELECT (SELECT (SELECT BrandName FROM brands WHERE BrandID = cars.BrandID) AS Brand FROM cars WHERE CarID = rental.CarID) AS Brand, (SELECT (SELECT ModelName FROM models where ModelID = cars.ModelID) AS Model FROM cars WHERE CarID = rental.CarID) AS Model, (SELECT FuelType FROM cars WHERE CarID = rental.CarID) AS FuelType, (SELECT Transmission FROM cars WHERE CarID = rental.CarID) AS Transmission, (SELECT ImageName FROM cars WHERE CarID = rental.CarID) AS ImageName FROM rentals rental WHERE UserID = '" . $_SESSION["UID"] . "' ORDER BY rental.RentalID DESC;";
        
        try{
          $execGetBookingCar = mysqli_query($conn, $getBookingCar);
          $rows = mysqli_fetch_assoc($execGetBookingCar);

          echo "<img src='./images/cars/" . $rows["ImageName"] . "' height='180px' width='277px'>
                  <p class='carBookingName'>" . $rows["Brand"] . "&nbsp;" . $rows["Model"] . "</p>
                  <span>
                      <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p>&nbsp;" . $rows["FuelType"] . "</p>
                  </span>
                  <span>
                      <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p>&nbsp;" . $rows["Transmission"] . "</p>
                  </span>";
        }catch(mysqli_sql_exception){
          echo "Error";
        }
      }elseif($_POST["action"] == "getBookingPickUp"){
        $getPickUp = "SELECT locations.Address, rentals.StartDate, (SELECT AmountPaid FROM payments WHERE payments.RentalID = rentals.RentalID) AS AmountPaid, (SELECT PaymentFrequency FROM payments WHERE payments.RentalID = rentals.RentalID) AS PaymentFrequency FROM rentals INNER JOIN locations ON rentals.PickUpLocationID = locations.LocationID WHERE rentals.UserID = '" . $_SESSION["UID"] . "' ORDER BY rentals.RentalID DESC;";

        try{
          $execGetPickUp = mysqli_query($conn, $getPickUp);
          $rows = mysqli_fetch_assoc($execGetPickUp);

          echo "<span>
                  <span id='rentPickupLocation'>
                      <p>Pick-Up Location</p>
                      <p>" . $rows["Address"] . "</p>
                  </span>
                  <span id='rentStartTime'>
                      <p>Pick-Up Time</p>
                      <p>" . explode(" ", $rows["StartDate"])[1] . "</p>
                  </span>
                  <span id='rentStartDate'>
                      <p>Pick-Up Date</p>
                      <p>" . explode(" ", $rows["StartDate"])[0] . "</p>
                  </span>
                  <span id='rentAmountPaid'>
                      <p>Amount Paid</p>
                      <p>₱" . $rows["AmountPaid"] . "</p>
                  </span>
                  <span id='rentPaymentFrequency'>
                      <p>Payment Frequency</p>
                      <p>" . $rows["PaymentFrequency"] . "</p>
                  </span>
              </span>";
        }catch(mysqli_sql_exception $e){
          echo "Error";
          echo $e;
        }
      }
    }
?>