<?php
  echo "<div class='voucherManagement'>
            <h4>Voucher Management & Statistics</h4>
            <span>
                <span>
                    <span onclick='showHideAddVoucher()'>
                        <p>Active Vouchers</p>
                        <p>12</p>
                        <p>Tap to add voucher</p>
                    </span>
                    <span onclick='showHideAddVoucher()'>
                        <p>Used Vouchers</p>
                        <p>12</p>
                        <p>Tap to add voucher</p>
                    </span>
                    <span onclick='showHideAddVoucher()'>
                        <p>Total Vouchers</p>
                        <p>12</p>
                        <p>Tap to add voucher</p>
                    </span>
                </span>
                <span class='vouchersTable'>
                    <span>
                        <p>Active Vouchers</p>
                        <span>
                            <table class='activeVouchersTable'>
                                <thead>
                                    <th>ID</th>
                                    <th>Deduction</th>
                                    <th>Expiry Date</th>
                                    <th>Used Times</th>
                                    <th>Max Usage</th>
                                </thead>
                                <tbody>";
                                $i = 0;
                                while($i < 20){
                                    echo "<tr>
                                            <td>$i</td>
                                            <td>21%</td>
                                            <td>2020-23-23</td>
                                            <td>3</td>
                                            <td>10</td>
                                        </tr>";
                                    $i++;
                                }
                                echo "</tbody>
                            </table>
                        </span>
                    </span>
                    <span>
                        <p>All Vouchers</p>
                        <span>
                            <table class='allVouchersTable'>
                                <thead>
                                    <th>ID</th>
                                    <th>Deduction</th>
                                    <th>Expiry Date</th>
                                    <th>Used Times</th>
                                    <th>Max Usage</th>
                                </thead>
                                <tbody>";
                                $i = 0;
                                while($i < 20){
                                    echo "<tr>
                                            <td>$i</td>
                                            <td>21%</td>
                                            <td>2020-23-23</td>
                                            <td>3</td>
                                            <td>10</td>
                                        </tr>";
                                    $i++;
                                }
                                echo "</tbody>
                            </table>
                        </span>
                    </span>
                    <div class='addVoucherCover' onclick='showHideAddVoucher()'></div>
                    <div class='addVoucher'>
                        <div>
                            <button onclick='showHideAddVoucher()'>&#215;</button>
                            <h4>Add Voucher</h4>
                            
                            <span>
                                <span>
                                    <label for='voucherDeduction'>Discount</label>
                                    <input type='number' id='voucherDeduction'>
                                </span>
                                <span>
                                    <label for='voucherType'>Type</label>
                                    <select id='voucherType'>
                                        <option value='Cash'>Cash</option>
                                        <option value='Percentage'>Percent</option>
                                    </select>
                                </span>
                            </span>
                            
                            <label for='voucherExpiryDate'>Expiry Date</label>
                            <input type='date' id='voucherExpiryDate'>

                            <label for='voucherMaxUsage'>Max Usage</label>
                            <input type='number' id='voucherMaxUsage'>

                            <button onclick='submitAddVoucher();'>Submit</button>
                        </div>
                    </div>
                </span>
                <span class='usedVouchersTable'>
                    <span>
                        <p>Used Voucher</p>
                        <span class>
                            <table>
                                <thead>
                                    <th>ID</th>
                                    <th>Deduction</th>
                                    <th>Expiry Date</th>
                                    <th>Used Times</th>
                                    <th>Max Usage</th>
                                </thead>
                                <tbody>";
                                $i = 0;
                                while($i < 20){
                                    echo "<tr>
                                            <td>$i</td>
                                            <td>21%</td>
                                            <td>2020-23-23</td>
                                            <td>3</td>
                                            <td>10</td>
                                        </tr>";
                                    $i++;
                                }
                                echo "</tbody>
                            </table>
                        </span>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript">
    const voucherDeduction = document.getElementById("voucherDeduction");
    const voucherType = document.getElementById("voucherType");
    const voucherExpiryDate = document.getElementById("voucherExpiryDate");
    const voucherMaxUsage = document.getElementById("voucherMaxUsage");

    function showHideAddVoucher(){
       document.querySelector(".addVoucherCover").classList.toggle("active");
       document.querySelector(".addVoucher").classList.toggle("active");
    }
    
    function submitAddVoucher(){
        if(voucherDeduction.value == "" || voucherType.value == "" || voucherExpiryDate.value == "" || voucherMaxUsage.value == ""){
            document.querySelector(".msg").innerHTML = "<p class='error'>Fields Cannot Be Empty!</p>";
        }else{
            $.ajax({
               type: 'post',
               url: './queries/rent/addVoucher.php',
               data: { voucherDeduction: voucherDeduction.value, voucherType: voucherType.value, voucherExpiryDate: voucherExpiryDate.value, voucherMaxUsage: voucherMaxUsage.value },
               success: function(res){
                  $(".msg").html(res);
                  showHideAddVoucher();
               },
               error: function(){
                  
               }
            });
        }
    }
</script>

<style type="text/css">
    .voucherManagement {
        width: 100%;
        height: 100%;
        display: none;
        flex-direction: column;
        overflow-y: hidden;
    }
    
    .voucherManagement > span {
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
        padding: 0px 25px;
    }

    .voucherManagement > span > span:not(:nth-child(2)) {
        scroll-snap-align: start;
    }

    .voucherManagement > span > span:nth-child(1) {
        display: flex;
        flex-direction: row;
        gap: 10px;
        margin-block: 10px;
    }

    .voucherManagement > span > span:nth-child(1) > span, .vouchersTable > span:nth-child(1), .vouchersTable > span:nth-child(2), .usedVouchersTable > span {
        background-color: #316C40;
        padding: 15px 20px;
        border-radius: 5px;
        text-align: center;
    }

    .voucherManagement > span > span:nth-child(1) > span > p:first-child{
        opacity: 0.8;
        border-bottom: 1px solid #FDFFF690;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }

    .voucherManagement > span > span:nth-child(1) > span > p:nth-child(2) {
        font-size: 20px;
    }

    .voucherManagement > span > span:nth-child(1) > span > p:nth-child(3) {
        font-size: 14px;
        opacity: 0.6;
    }

    .vouchersTable > span:nth-child(1), .vouchersTable > span:nth-child(2), .usedVouchersTable > span {
        padding: 0px 20px 15px 20px;
    }

    .vouchersTable, .usedVouchersTable {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        height: 70%;
    }

    .vouchersTable > span {
        width: 49.5%;
        overflow: scroll;
        height: 100%;
    }

    .vouchersTable > span > span > table, .usedVouchersTable > span > span > table, .usedVouchersTable > span {
        width: 100%;
    }

    .vouchersTable > span > p:first-child, .usedVouchersTable > span > p:first-child {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: 316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
    }
    
    .activeVouchersTable, .allVouchersTable, .usedVouchersTable > span > span > table {
        text-align: left;
        color: #FDFFF6;
    }
    
    .activeVouchersTable th, .allVouchersTable th, .activeVouchersTable td, .allVouchersTable td, .usedVouchersTable th, .usedVouchersTable td {
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }

    .activeVouchersTable th, .allVouchersTable th, .usedVouchersTable th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 56px;
        background-color: #316C40;
    }

    .activeVouchersTable td, .allVouchersTable td, .usedVouchersTable td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        font-family: space-grotesk-regular;
    }

    .activeVouchersTable tr:nth-child(even) td, .allVouchersTable tr:nth-child(even) td, .usedVouchersTable tr:nth-child(even) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }

    .activeVouchersTable tr:nth-child(odd), .allVouchersTable tr:nth-child(odd), .usedVouchersTable tr:nth-child(odd) {
        background-color: #38814a;
    }

    .voucherManagement > span > span:nth-child(3) {
        margin-block: 10px;
        width: 100%;
        height: 95%;
    }

    .usedVouchersTable {
        width: 100%;
    }

    .usedVouchersTable > span {
        overflow: scroll;
    }
    
    .addVoucherCover {
        position: absolute;
        top: 0px; left: 0px;
        display: none;
        height: 100vh;
        width: 100vw;
        background-color: #031A0980;
        z-index: 100;
    }
    
    .addVoucherCover.active {
        display: block;
    }

    .addVoucher {
        position: absolute;
        top: 0px; left: 0px;
        display: none;
        height: 100vh;
        width: 100vw;
        place-items: center;
        z-index: 105;
        pointer-events: none;
    }
    
    .addVoucher.active {
        display: grid;
    }

    .addVoucher > div {
        background-color: #316C40;
        border-radius: 5px;
        padding: 20px 30px;
        border: 2px solid #E2F87B;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: all;
    }
    
    .addVoucher > div > h4 {
        border-bottom: 2px solid #FDFFF680;
        padding-bottom: 5px;
        font-size: 24px;
        text-align: center;
    }
    
    .addVoucher > div > span:nth-child(3){
      display: flex;
      flex-direction: row;
      gap: 5px;
    }
    
    .addVoucher > div > span:nth-child(3) > span {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .addVoucher input, .addVoucher select {
        background-color: #316C40;
        border: none;
        border-bottom: 1px solid #E2F87B;
        color: #FDFFF6;
        outline: none;
        padding-block: 2.5px;
        height: 26px;
    }

    .addVoucher label {
        font-size: 14px;
        opacity: 0.8;
        transform: translateY(10px);
    }

    .addVoucher button {
        background-color: #E2F87B;
        border-radius: 5px;
        outline: none;
        border: none;
        color: #316C40;
        padding-block: 5px;
    }
    
    .addVoucher > div > button:first-child {
        height: 0px;
        position: relative;
        text-align: right;
        left: 12.5px;
        background-color: #316C40;
        color: #E2F87B;
        padding-block: 0px;
        bottom: 10px;
    }

    .addVoucher input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .addVoucher input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .addVoucher input[type="date"]::-webkit-calendar-picker-indicator {
        position: relative;
        bottom: 6px;
        right: 6px;
        filter: invert();
    }
</style>