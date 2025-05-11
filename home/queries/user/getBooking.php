<?php
    session_start();

    require_once("../../../database/db_conn.php");

    // Rentals status 0 = pending; 1 = confirmed; 2 = ongoing; 3 = completed; 4 = cancelled; 5 = declined
    if(isset($_GET)){
      if($_POST["action"] == "getHistory"){
        $getBookingHistoryQuery = "SELECT (SELECT (SELECT BrandName FROM brands WHERE BrandID = cars.BrandID) AS Brand FROM cars WHERE CarID = rental.CarID) AS Brand, (SELECT (SELECT ModelName FROM models where ModelID = cars.ModelID) AS Model FROM cars WHERE CarID = rental.CarID) AS Model, rental.StartDate, rental.EndDate, rental.Status, DATEDIFF(rental.EndDate, rental.StartDate) AS Duration, payment.AmountPaid, payment.PaymentFrequency, rental.status, rental.Penalty FROM rentals rental INNER JOIN payments payment ON rental.RentalID = payment.RentalID WHERE UserID = '" . $_SESSION["userID"] . "' ORDER BY rental.RentalID DESC;";
        $execGetBookingHistoryQuery = mysqli_query($conn, $getBookingHistoryQuery);
        
        $i = mysqli_num_rows($execGetBookingHistoryQuery);
        if(mysqli_num_rows($execGetBookingHistoryQuery) != 0){
          while($rows = mysqli_fetch_assoc($execGetBookingHistoryQuery)){
              $status = "";
                switch($rows["status"]){
                    case 0:
                        $status = "Pending";
                        break;
                    case 1:
                        $status = "Confirmed";
                        break;
                    case 2:
                        $status = "Ongoing";
                        break;
                    case 3:
                        $status = "Completed";
                        break;
                    case 4:
                        $status = "Cancelled";
                        break;
                    case 5:
                        $status = "Declined";
                        break;
              }

              echo "<tr>
                  <td>$i</td>
                  <td>" . $rows["Brand"] . "&nbsp;" . $rows["Model"] . "</td>
                  <td>" . $rows["StartDate"] . "</td>
                  <td>" . $rows["EndDate"] . "</td>
                  <td>"; echo $rows["Duration"] == 1 ? $rows["Duration"] . "&nbsp;Day" : $rows["Duration"] . "&nbsp;Days"; echo"</td>
                  <td>" . $rows["AmountPaid"] . "</td>
                  <td>" . $rows["Penalty"] . "</td>
                  <td>" . $rows["PaymentFrequency"] . "</td>
                  <td>$status</th>
              </tr>";
              $i--;
          }
        }else{
          echo "<tr>
                  <td colspan='9' style='text-align: center;'>No history yet</td>
                </tr>";
        }
      }elseif($_POST["action"] == "getCar"){
        $getBookingCar = "SELECT cars.CarID, cars.FuelType, cars.Transmission, cars.ImageName, (SELECT BrandName FROM brands WHERE BrandID = cars.BrandID) AS Brand, (SELECT ModelName FROM models WHERE ModelID = cars.ModelID) AS Model, TIMESTAMPDIFF(HOUR, rentals.StartDate, NOW()) AS isOverTime, TIMESTAMPDIFF(MINUTE, rentals.EndDate, NOW()) AS ReturnPenalty, rentals.Status, rentals.RentalID FROM cars INNER JOIN rentals ON rentals.CarID = cars.CarID WHERE UserID = '" . $_SESSION["userID"] . "' AND rentals.Status = 0 OR rentals.Status = 1 OR rentals.Status = 2 ORDER BY rentals.RentalID DESC LIMIT 1;";
        
        try{
          $execGetBookingCar = mysqli_query($conn, $getBookingCar);

          if($rows = mysqli_fetch_assoc($execGetBookingCar)){

            if($rows["isOverTime"] >= 12 && $rows["Status"] != 2){
              $autoCancelBooking = "UPDATE rentals SET Status = 4 WHERE RentalID = '" . $rows["RentalID"] . "'";
              mysqli_query($conn, $autoCancelBooking);
              
              $setCarAvailability = "UPDATE cars SET Availability = 1 WHERE CarID = '" . $rows["CarID"] . "'";
              mysqli_query($conn, $setCarAvailability);
              
              $cancelPayment = "UPDATE payments SET PaymentStatus = 2 WHERE RentalID = '" . $rows["RentalID"] . "'";
              mysqli_query($conn, $cancelPayment);
            }

            echo "<img src='./images/cars/" . $rows["ImageName"] . "' height='180px' width='277px' id='bookingCarStats' class='" . $rows["CarID"] . "'>
                    <p class='carBookingName'>" . $rows["Brand"] . "&nbsp;" . $rows["Model"] . "</p>
                    <span>
                      <span>
                          <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p>&nbsp;" . $rows["FuelType"] . "</p>
                      </span>
                      <span>
                          <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p>&nbsp;" . $rows["Transmission"] . "</p>
                      </span>";
                      if($rows["isOverTime"] >= 12 && $rows["Status"] != 2){
                        echo "<span class='bookingCancelled'>";
                        echo "<svg viewBox='0 0 512 512' fill='#E2F87B'><path d='M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z'/></svg><p>&nbspBooking Cancelled</p>";
                      }elseif($rows["Status"] == 0){
                        echo "<span class='bookingWaitApproval'>";
                        echo "<svg viewBox='0 0 512 512' fill='#316C40'><path d='M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z'/></svg><p>&nbspWaiting For Approval</p>";
                      }else{
                        echo "<span>";
                        echo "<img src='./images/icons/availability-icon.svg' height='14px' width='14px'><p>&nbsp;"; echo $rows["Status"] == 2 ? "Ongoing" : ($rows["isOverTime"] >= -12 && $rows["Status"] == 1 ? "Ready for pick-up" : "Upcoming"); echo "</p>";
                        echo "</span>
                            </span>";

                        echo "<span class='bookingActions'>";
                          echo $rows["isOverTime"] >= -12 && $rows["Status"] == 1 ? "<button onclick='retrieveBookedCar(" . $rows["RentalID"] . ", " . $rows["CarID"] . ", &#x27;show&#x27;)'>Retrieve Car</button>" : "<button disabled>Retrieve Car</button>";
                          echo $rows["Status"] == 2 && $rows["ReturnPenalty"] >= -(60*12) ? "<button onclick='returnBookedCar(" . $rows["RentalID"] . ", " . $rows["CarID"] . ", &#x27;show&#x27;)'>Return Car</button>" : "<button disabled>Return Car</button>";
                          echo $rows["Status"] == 2 && $rows["ReturnPenalty"] >= -(60*6) ? ($rows["ReturnPenalty"] > 0 ? "<p style='color: #e27c00;' id='lateReturnTime'>Late Return <span id='lateReturn'>" . ($rows["ReturnPenalty"] > 60 ? number_format(($rows["ReturnPenalty"] / 60), 0) . "</span> Hour/s ago</p>" : $rows["ReturnPenalty"] . "</span> Minute/s ago</p>") : "<p>Late Return Penalty In: " . ($rows["ReturnPenalty"] < -60 ? number_format(abs($rows["ReturnPenalty"] / 60), 0) . " Hour/s</p>" : abs($rows["ReturnPenalty"]) . " Minute/s</p>" ) ) : "";
                        echo "</span>";
                      }
          }else{
            echo "No Car Rent";
          }
        }catch(mysqli_sql_exception){
          echo "Error";
        }
      }elseif($_POST["action"] == "getBookingPickUp"){
        $getPickUp = "SELECT locations.Address, rentals.StartDate, (SELECT AmountPaid FROM payments WHERE payments.RentalID = rentals.RentalID) AS AmountPaid, (SELECT PaymentFrequency FROM payments WHERE payments.RentalID = rentals.RentalID) AS PaymentFrequency FROM rentals INNER JOIN locations ON rentals.PickUpLocationID = locations.LocationID WHERE rentals.UserID = '" . $_SESSION["userID"] . "' AND rentals.Status = 0 OR rentals.Status = 1 OR rentals.Status = 2 ORDER BY rentals.RentalID DESC;";

        try{
          $execGetPickUp = mysqli_query($conn, $getPickUp);
          
          if($rows = mysqli_fetch_assoc($execGetPickUp)){
            echo "<span>
                    <span id='rentPickupLocation'>
                        <span>
                          <p>Pick-Up Location</p>
                          <p>" . $rows["Address"] . "</p>
                        </span>
                    </span>
                    <span id='rentStartTime'>
                        <span>
                          <p>Pick-Up Time</p>
                          <p>" . explode(" ", $rows["StartDate"])[1] . "</p>
                        </span>
                    </span>
                    <span id='rentStartDate'>
                        <span>
                          <p>Pick-Up Date</p>
                          <p>" . explode(" ", $rows["StartDate"])[0] . "</p>
                        </span>
                    </span>
                    <span id='rentAmountPaid'>
                        <span>
                          <p>Amount Paid</p>
                          <p>₱" . $rows["AmountPaid"] . "</p>
                        </span>
                    </span>
                    <span id='rentPaymentFrequency'>
                        <span>
                          <p>Payment Frequency</p>
                          <p>" . $rows["PaymentFrequency"] . "</p>
                        </span>
                    </span>
                </span>";
          }
        }catch(mysqli_sql_exception){
          echo "Error";
        }
      }elseif($_POST["action"] == "getBookingDropOff"){
        $getDropOff = "SELECT locations.Address, rentals.EndDate FROM rentals INNER JOIN locations ON locations.LocationID = rentals.DropOffLocationID WHERE rentals.Status = 0 OR rentals.Status = 1 OR rentals.Status = 2;";
       
        try{
          $exeGetDropOff = mysqli_query($conn, $getDropOff);
          
          if($rows = mysqli_fetch_assoc($exeGetDropOff)){
            echo "<span>
                    <span id='rentDropOffLocation'>
                        <span>
                          <p>Drop-Off Location</p>
                          <p>" . $rows["Address"] . "</p>
                        </span>
                    </span>
                    <span id='rentEndTime'>
                        <span>
                          <p>Return Time</p>
                          <p>" . explode(" ", $rows["EndDate"])[1] . "</p>
                        </span>
                    </span>
                    <span id='returnDate'>
                        <span>
                          <p>Return Date</p>
                          <p>" . explode(" ", $rows["EndDate"])[0] . "</p>
                        </span>
                    </span>
                </span>";
          }
        }catch(mysqli_sql_exception){
          echo "Error";
        }
      }
    }
?>