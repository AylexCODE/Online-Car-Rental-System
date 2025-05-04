<?php
  echo "<div class='rentals'>
          <h4>Rental Management & Statistics</h4>
          <span>
            <span>
                <span>
                    <p>Active Rentals</p>
                    <table>
                        <thead>
                            <th>Rental ID</th>
                            <th>User</th>
                            <th>Car</th>
                            <th>Pick-Up Date</th>
                            <th>Drop-Off Date</th>
                            <th>Status</th>
                        </thead>
                        <tr class='rentalSearchBar'>
                            <td><input type='number' id='activeFilterRentalID' oninput='getActiveRentals();'></td>
                            <td><input type='search' id='activeFilterUser' oninput='getActiveRentals();'></td>
                            <td><input type='search' id='activeFilterCar' oninput='getActiveRentals();'></td>
                            <td><input type='date' id='activeFilterPickD' oninput='getActiveRentals();'></td>
                            <td><input type='date' id='activeFilterDropD' onchange='getActiveRentals();'></td>
                            <td>
                                <select id='activeFilterStatus' onchange='getActiveRentals();'>
                                    <option value=''>All</option>
                                    <option value='0'>Pending</option>
                                    <option value='1'>Confirmed</option>
                                    <option value='2'>Ongoing</option>
                                </select>
                            </td>
                        </tr>
                        <tbody id='activeRentals'></tbody>
                    </table>
                </span>
            </span>
            <span>
                <span>
                    <p>Rentals History</p>
                    <table>
                        <thead>
                            <tr class='activeRentalLabel'>
                            <th>Rental ID</th>
                            <th>User</th>
                            <th>Car</th>
                            <th>Pick-Up Date</th>
                            <th>Drop-Off Date</th>
                            <th>Status</th>
                            </tr>
                            <tr class='rentalSearchBar'>
                                <td><input type='number' id='historyFilterRentalID' oninput='getRentalsHistory();'></td>
                                <td><input type='search' list='usersList' id='historyFilterUser' oninput='getRentalsHistory();'></td>
                                <td><input type='search' id='historyFilterCar' oninput='getRentalsHistory();'></td>
                                <td><input type='date' id='historyFilterPickD' oninput='getRentalsHistory();'></td>
                                <td><input type='date' id='historyFilterDropD' onchange='getRentalsHistory();'></td>
                                <td>
                                    <select id='historyFilterStatus' onchange='getRentalsHistory();'>
                                        <option value=''>All</option>
                                        <option value='3'>Completed</option>
                                        <option value='4'>Cancelled</option>
                                        <option value='5'>Declined</option>
                                    </select>
                                </td>
                            </tr>
                        </thead>
                        <tbody id='rentalHistory'></tbody>
                    </table>
                </span>
            </span>
        </span>
    </div>";
?>

<script type="text/javascript">
    const activeFilterRentalID = document.getElementById("activeFilterRentalID");
    const activeFilterUser = document.getElementById("activeFilterUser");
    const activeFilterCar = document.getElementById("activeFilterCar");
    const activeFilterPickD = document.getElementById("activeFilterPickD");
    const activeFilterDropD = document.getElementById("activeFilterDropD");
    const activeFilterStatus = document.getElementById("activeFilterStatus");

    const historyFilterRentalID = document.getElementById("historyFilterRentalID");
    const historyFilterUser = document.getElementById("historyFilterUser");
    const historyFilterCar = document.getElementById("historyFilterCar");
    const historyFilterPickD = document.getElementById("historyFilterPickD");
    const historyFilterDropD = document.getElementById("historyFilterDropD");
    const historyFilterStatus = document.getElementById("historyFilterStatus");

    function getActiveRentals(){
        console.log("E");
        $.ajax({
            type: 'post',
            url: './queries/rent/getRentals.php',
            data: { type: 'active', rentalID: activeFilterRentalID.value, user: activeFilterUser.value, car: activeFilterCar.value, pickUpDate: activeFilterPickD.value, dropOffDate: activeFilterDropD.value, status: activeFilterStatus.value },
            success: function(res){
                $("#activeRentals").html(res);
            },
            error: function(error){
                console.log(error)
            }
        });
    }
    
    function getRentalsHistory(){
        $.ajax({
            type: 'post',
            url: './queries/rent/getRentals.php',
            data: { type: 'history', rentalID: historyFilterRentalID.value, user: historyFilterUser.value, car: historyFilterCar.value, pickUpDate: historyFilterPickD.value, dropOffDate: historyFilterDropD.value, status: historyFilterStatus.value },
            success: function(res){
                $("#rentalHistory").html(res);
            },
            error: function(error){
                console.log(error)
            }
        });
    }

    function activeRentAction(action, rentID, carID){
        $.ajax({
            type: 'post',
            url: './queries/rent/activeRentAction.php',
            data: { action: action, rentID: rentID, carID: carID },
            success: function(res){
                getActiveRentals();
                getRentalsHistory();
                socket.emit('update_user', 'Ok');
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    getActiveRentals();
    getRentalsHistory();
</script>

<style type="text/css">
    .rentals {
        height: 100%;
        width: 100%;
        display: none;
        overflow-y: hidden;
    }
    
    .rentals > span {
        padding: 0px 25px;
        height: 100%;
        display: block;
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
    }

    .rentals > span > span {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        scroll-snap-align: start;
        gap: 5px;
        padding-bottom: 10px;
    }

    .rentals > span > span:nth-child(2){
        margin-block: 10px;
    }

    .rentals > span > span > span {
        background-color: #316C40;
        height: 100%;
        width: 100%;
        overflow: scroll;
        padding: 0px 20px 15px 20px;
        border-radius: 5px;
    }

    .rentals > span > span > span > p {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: #316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
    }

    .rentals > span > span > span > table {
        width: 100%;
        text-align: left;
        color: #FDFFF6;
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }

    .rentals th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 56px;
        background-color: #316C40;
    }

    .rentals tr:nth-child(even) td {
        background-color: #38814a;
        outline: 1px solid #38814a;
        padding: 20px 10px;
    }
    
    .rentals tr:nth-child(odd) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }
    
    .rentals td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        overflow-x: scroll;
    }

    .rentals tr:nth-child(even):has(button) td, .rentals tr:nth-child(odd):has(button) td {
        padding: 10px 10px;
    }

    .rentalSearchBar {
        position: sticky;
        top: 88px;
        background-color: #316C40;
    }

    .rentalSearchBar > td {
        border-bottom: 1px solid #E2F87B70;
        padding: 0px 0px;
    }

    .rentals > span > span > span > table input, .rentals > span > span > span > table select {
        width: 100%;
        outline: none;
        border: 1px solid #FDFFF6;
        /* margin-block: 10px; */
        background-color: #295234;
        padding: 0px 10px;
        height: 40px;
        border-radius: 5px;
        color: #FDFFF6;
    }

    .rentals > span > span > span > table input::-webkit-search-cancel-button {
        color: #FDFFF6;
        -webkit-appearance: none;
        appearance: none;
        height: 12px;
        width: 15px;
        position: relative;
        left: 7.5px;
        background-image: url("./images/icons/x-icon.svg");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .rentals > span > span > span > table input::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .rentals > span > span > span > table select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 0px;
    }

    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .rentals tr > td:last-child{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .rentals tr > td:last-child > button {
        padding: 5px 2.5px;
        outline: none;
        border: 1px solid #076d0d;
        border-radius: 5px;
        background-color: #00b809;
        color: #FDFFF6;
    }

    .rentals tr > td:last-child > button:last-child {
        border-color: #b10303;
        background-color: #ff2323;
    }

    .rentals th:first-child {
        width: 80px;
    }

    #activeRentals td:nth-child(2), #rentalHistory td:nth-child(2){
        min-width: 110px;
        max-width: 110px;
    }

    #activeRentals td:nth-child(3), #rentalHistory td:nth-child(2){
        min-width: 110px;
        max-width: 110px;
    }
</style>