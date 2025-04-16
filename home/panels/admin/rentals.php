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
                                <td><input type='number'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td>
                                    <select>
                                        <option>Accepted</option>
                                        <option>Declined</option>
                                    </select>
                                </td>
                            </tr>
                        </thead>
                        <tbody>";
                        $i = 0;
                        while($i < 20){
                            echo "<tr>
                            <td>$i</td>
                            <td>LEY LEY LEYL YEYAHASKJ</td>
                            <td>FORD SUPRA TOYOA</td>
                            <td>2025-12-12 12:12:12</td>
                            <td>2025-12-12 12:12:12</td>
                            <td>Accepted</td>
                            </tr>";
                            $i++;
                        }

                        echo "</tbody>
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
                                <td><input type='number'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td><input type='text'></td>
                                <td>
                                    <select>
                                        <option>Accepted</option>
                                        <option>Declined</option>
                                    </select>
                                </td>
                            </tr>
                        </thead>
                        <tbody>";
                        $i = 0;
                        while($i < 20){
                            echo "<tr>
                            <td>$i</td>
                            <td>LEY LEY LEYL YEYAHASKJ</td>
                            <td>FORD SUPRA TOYOA</td>
                            <td>2025-12-12 12:12:12</td>
                            <td>2025-12-12 12:12:12</td>
                            <td>Accepted</td>
                            </tr>";
                            $i++;
                        }

                        echo "</tbody>
                        </tr>
                    </table>
                </span>
            </span>
        </span>
    </div>";
?>

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
    }

    .rentals > span > span > p {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .rentals > span > span > span > table {
        border-collapse: collapse;
        width: 100%;
        background-color: #316C40;
        color: #FDFFF6;
        text-wrap: nowrap;
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
    
    /* .rentals > span > span > table th:is(:last-child){
        border-radius: 0px 5px 0px 0px;
    }

    .rentals > span > span > table th:not(:first-child, :last-child){
        border-radius: 0px;
        border: 1px solid #FDFFF650;
        border-top: none;
    } */

    .rentals > span > span > span > table input, .rentals > span > span > span > table select {
        width: 100%;
        outline: none;
        border: 1px solid #FDFFF6;
        /* margin-block: 10px; */
        background-color: #316C40;
        padding: 0px 10px;
        height: 40px;
        border-radius: 5px;
        color: #FDFFF6;
    }

    .rentals > span > span > span > table select {
        padding: 5px 0px;
    }

    .rentals > span > span > span > table td {
        border: 1px 0px 1px 0px solid #FDFFF650;
        padding: 20px 10px;
        text-align: left;
        overflow-x: scroll;
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
        background-color: #38814a;
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
</style>