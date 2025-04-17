<?php
  echo "<div class='rentals'>
          <h4>Rentals</h4>
          <span>
            <span>
                <p>Active Rentals</p>
                <span>
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
                            <tr class='activeRentalsFilter'>
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
                                    </select>
                                </td>
                            </tr>
                        </thead>
                        <tbody id='activeRentals'></tbody>
                        </tr>
                    </table>
                </span>
            </span>
            <span>
                <p>Rentals History</p>
                <span>
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
                            <tr class='activeRentalsFilter'>
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
                        </tr>
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
                console.log(res)
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
    }
    
    .rentals > span {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
        & ::-webkit-scrollbar{
            display: none;
        }
    }
    
    .rentals > span > span {
        display: block;
        height: 100%;
        scroll-snap-align: start;
        margin-bottom: 20px;
    }

    .rentals > span > span > p {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .rentals > span > span > span > table {
        border-collapse: separate;
        width: 100%;
        background-color: #316C40;
        color: #FDFFF6;
        text-wrap: nowrap;
        border-spacing: 0;
    }

    .rentals > span > span > span {
        display: block;
        min-height: 0px;
        max-height: 90%;
        overflow: scroll;
        border: 1px solid #FDFFF650;
        border-top: none;
        border-radius: 5px;
    }
    
    .rentals > span > span > span > table th{
        position: sticky;
        top: 0px;
        padding: 20px 10px;
        background-color: #e27c00;
        text-align: left;
    }
    
    .rentals > span > span > span > table th:is(:first-child){
        border-radius: 5px 0px 0px 0px;
        width: 90px;
    }
    
    .rentals > span > span > span > table th:is(:last-child){
        width: 110px;
    }

    /* .rentals > span > span > table th:not(:first-child, :last-child){
        border-radius: 0px;
        border: 1px solid #FDFFF650;
        border-top: none;
    } */

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
        background-image: url("./images/icons/x-icon.svg");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .rentals > span > span > span > table select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 0px;
    }

    .rentals > span > span > span > table td {
        border: 1px 0px 1px 0px solid #FDFFF650;
        padding: 10px 10px;
        text-align: left;
        overflow-x: scroll;
    }

    .rentals > span > span:nth-child(2) > span > table td {
        padding: 20px 10px;
    }

    .rentals > span > span > span > table tr:nth-child(odd){
        background-color: #38814a;
    }
    
    .rentals > span > span > span > table tr:not(.activeRentalsFilter, .activeRentalLabel){
        border-bottom: 1px solid #FDFFF650;
    }

    .rentals > span > span > span > table tr:hover:not(.activeRentalsFilter){
        background-color: #499e5e;
    }

    .activeRentalsFilter {
        position: sticky;
        top: 59px;
        background-color: #295234;
        height: 20px;
    }

    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .activeRentalstatusAction {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .activeRentalstatusAction > button {
        padding: 5px 2.5px;
        outline: none;
        border: 1px solid #076d0d;
        border-radius: 5px;
        background-color: #00b809;
        color: #FDFFF6;
    }

    .activeRentalstatusAction > button:last-child {
        border-color: #b10303;
        background-color: #ff2323;
    }
</style>