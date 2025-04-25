<?php
    echo "<div class='payments'>
            <h4>Payments</h4>
            <span>
                <span>
                    <span class='paymentStatisticsWrapper'>
                        <span id='paymentCustomerCount'>
                            <p>Customer Count</p>
                            <p>192</p>
                        </span>
                        <span id='paymentTotalAmount'>
                            <p>Total Amount</p>
                            <p>19212.99</p>
                        </span>
                    </span>
                    <span class='paymentsTable'>
                        <p>Payments History</p>
                        <table>
                            <thead>
                                <th>Pay ID</th>
                                <th>Rent ID</th>
                                <th>Customer Name</th>
                                <th>Amount Paid</th>
                                <th>Pay Method</th>
                                <th>Pay Frequency</th>
                                <th>Payment Date</th>
                                <th>Voucher ID</th>
                            </thead>
                            <tr class='paymentsFilter'>
                                <td><input type='number' id='filterPayID' oninput='filterPayments();'></td>
                                <td><input type='number' id='filterPayRentID' oninput='filterPayments();'></td>
                                <td><input type='search' id='filterPayName' oninput='filterPayments();'></td>
                                <td><input type='number' id='filterPayPaid' oninput='filterPayments();'></td>
                                <td>
                                    <select id='filterPayMethod' onchange='filterPayments();'>
                                        <option value='All'>All</option>
                                        <option value='Credit/Debit Card'>Credit/Debit Card</option>
                                        <option value='PayPal'>PayPal</option>
                                        <option value='GCash'>GCash</option>
                                        <option value='Bank Transfer'>Bank Transfer</option>
                                        <option value='Cash-On-Pickup'>Cash-On-Pickup</option>
                                    </select>
                                </td>
                                <td>
                                    <select id='filterPayFreq' onchange='filterPayments();'>
                                        <option value='All'>All</option>
                                        <option value='Daily' id='payDaily'>Daily</option>
                                        <option value='Weekly' id='payWeekly'>Weekly</option>
                                        <option value='Monthly' id='payMonthly'>Monthly</option>
                                    </select>
                                </td>
                                <td><input type='datetime-local' id='filterPayDate' onchange='filterPayments();'></td>
                                <td><input type='number' id='filterPayVoucherID' oninput='filterPayments();'></td>
                            </tr>
                            <tbody>";
                            $l = 0;
                            while($l < 15){
                                echo "<tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>Ley</td>
                                    <td>12121</td>
                                    <td>Cash</td>
                                    <td>Monthly</td>
                                    <td>2025-09-12 12:34:50</td>
                                    <td>None</td>
                                </tr>";
                                $l++;
                            }
                            echo "</tbody>
                        </table>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript">
    const filterPayId = document.getElementById("filterPayID");
    const filterPayRentID = document.getElementById("filterPayRentID");
    const filterPayName = document.getElementById("filterPayName");
    const filterPayPaid = document.getElementById("filterPayPaid");
    const filterPayMethod = document.getElementById("filterPayMethod");
    const filterPayFreq = document.getElementById("filterPayFreq");
    const filterPayDate = document.getElementById("filterPayDate");
    const filterPayVoucherID = document.getElementById("filterPayVoucherID");
    
    function filterPayments(){
        $.ajax({
            type: 'post',
            url: './queries/rent/getPayments.php',
            data: { m: 'getPayments', filterPayId: filterPayId.value, filterPayRentID: filterPayRentID.value, filterPayName.value, filterPayPaid: filterPayPaid.value, filterPayMethod: filterPayMethod.value, filterPayFreq: filterPayFreq.value, filterPayDate: filterPayDate.value, filterPayVoucherID: filterPayVoucherID.value },
            success: function(res){
                
            },
            error: function(){
                
            }
        });
    }
</script>

<style type="text/css">
    .payments {
        height: 100%;
    }

    .payments > span {
        height: 100%;
        padding: 0px 25px;
        overflow-y: scroll;
    }

    .payments > span > span {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        gap: 5px;
        padding-bottom: 10px;
    }

    .paymentStatisticsWrapper {
        display: flex;
        flex-direction: row;
        gap: 5px;
        width: 100%;
    }
    
    .paymentStatisticsWrapper > span {
        background-color: #316C40;
        padding: 15px 20px;
        border-radius: 5px;
        padding-right: 70px;
    }
    
    .paymentStatisticsWrapper > span > p:nth-child(1){
        opacity: 0.8;
        font-size: 16px;
    }

    .paymentStatisticsWrapper > span > p:nth-child(2){
        font-size: 20px;
    }
    
    .paymentsTable {
        background-color: #316C40;
        border-radius: 5px;
        padding: 0px 20px 15px 20px;
        overflow-y: scroll;
        display: block;
        height: 100%;
    }

    .paymentsTable > p {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: #316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
    }

    .paymentsTable > table{
        width: 100%;
        text-align: left;
        color: #FDFFF6;
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }
    
    .paymentsTable th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 56px;
        background-color: #316C40;
    }
    
    .paymentsTable tr:nth-child(even){
        background-color: #38814a;
    }
    
    .paymentsTable tr:nth-child(odd) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }

    .paymentsFilter {
        position: sticky;
        top: 88px;
        background-color: #316C40;
    }
    
    .paymentsFilter td {
        border-bottom: 1px solid #E2F87B70;
        padding: 0px 0px;
    }
    
    .paymentsTable td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        overflow-x: scroll;
    }
    
    .paymentsTable input, .paymentsTable select {
        width: 100%;
        outline: none;
        border: 1px solid #FDFFF6;
        background-color: #295234;
        padding: 0px 10px;
        height: 40px;
        border-radius: 5px;
        color: #FDFFF6;
    }

    .paymentsTable > table input::-webkit-search-cancel-button {
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

    .paymentsTable > table input::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .paymentsTable > table select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 2.5px;
    }

    .paymentsFilter td:nth-child(3) {
        max-width: 100px;
        min-width: 100px;
    }

    .paymentsFilter td:nth-child(7) {
        max-width: 240px;
        min-width: 240px;
    }
</style>