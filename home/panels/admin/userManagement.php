<?php
    echo "<div class='userManagement'>
            <h4>User Management & Statistics</h4>
            <span>
                <span>
                    <span class='usersTable'>
                        <div>
                            <p>Users (12 Total)</p>
                            <span>
                                <p>Filter by:</p>
                                <select>
                                    <option>UID</option>
                                    <option>Name</option>
                                    <option>Email</option>
                                    <option>Age</option>
                                    <option>Reg. Date</option>
                                    <option>Rents</option>
                                    <option>Preference</option>
                                </select>
                                <select>
                                    <option>ASC</option>
                                    <option>DESC</option>
                                </select>
                            </span>
                        </div>
                        <table>
                            <thead>
                                <th>UID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No.</th>
                                <th>Age</th>
                                <th>Driver's License</th>
                                <th>Registered Date</th>
                                <th>Rents</th>
                                <th>Car Preference</th>
                            </thead>
                            <tr class='usersFilter'>
                                <td><input type='number' id='uFilterUID'></td>
                                <td><input type='search' id='uName'></td>
                                <td><input type='number' id='uEmail'></td>
                                <td><input type='search' id='uPhoneNo'></td>
                                <td><input type='number' id='uAge'></td>
                                <td><input type='search' id='uDLicense'></td>
                                <td><input type='date' id='uRegDate'></td>
                                <td><input type='number' id='uRentTimes'></td>
                                <td><input type='search' id='uPreference'></td>
                            </tr>
                            <tbody id='usersList'></tbody>
                        </table>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript">
    const uFilterUID = document.getElementById("uFilterUID");
    const uName = document.getElementById("uName");
    const uEmail = document.getElementById("uEmail");
    const uPhoneNo = document.getElementById("uPhoneNo");
    const uAge = document.getElementById("uAge");
    const uDLicense = document.getElementById("uDLicense");
    const uRegDate = document.getElementById("uRegDate");
    const uRentTimes = document.getElementById("uRentTimes");
    const uPreference = document.getElementById("uPreference");

    function getUsers(){
        $.ajax({
            type: 'post',
            url: './queries/user/getUsers.php',
            data: { uFilterUID: uFilterUID.value, uName: uName.value, uEmail: uEmail.value, uPhoneNo: uPhoneNo.value, uAge: uAge.value, uDLicense: uDLicense.value, uRegDate: uRegDate.value, uRentTimes: uRentTimes.value, uPreference: uPreference.value },
            success: function(res){
                $("#usersList").html(res);
            },
            error: function(){

            }
        });
    }

    getUsers();
</script>

<style type="text/css">
    .userManagement {
        height: 100%;
    }

    .userManagement > span {
        height: 100%;
        padding: 0px 25px;
        overflow-y: scroll;
    }

    .userManagement > span > span {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
        gap: 5px;
        padding-bottom: 10px;
    }
    
    .usersTable {
        background-color: #316C40;
        border-radius: 5px;
        padding: 0px 20px 15px 20px;
        overflow-y: scroll;
        display: block;
        height: 100%;
    }

    .usersTable > div {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: #316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        text-wrap: nowrap;
    }

    .usersTable > div > span {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .usersTable > div > span > p {
      opacity: 0.8;
    }

    .usersTable > table{
        width: 100%;
        text-align: left;
        color: #FDFFF6;
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }
    
    .usersTable th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 53px;
        background-color: #316C40;
    }
    
    .usersTable tr:nth-child(even){
        background-color: #38814a;
    }
    
    .usersTable tr:nth-child(odd) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }

    .usersFilter {
        position: sticky;
        top: 85px;
        background-color: #316C40;
    }
    
    .usersFilter td {
        border-bottom: 1px solid #E2F87B70;
        padding: 0px 0px;
    }
    
    .usersTable td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        overflow-x: scroll;
    }
    
    .usersTable input, .usersTable select {
        width: 100%;
        outline: none;
        border: 1px solid #FDFFF6;
        background-color: #295234;
        padding: 0px 5px;
        height: 40px;
        border-radius: 5px;
        color: #FDFFF6;
    }

    .usersTable > table input::-webkit-search-cancel-button {
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

    .usersTable > table input::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .usersTable > div > span select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 2.5px;
        background-color: #316C40;
        border: none;
        height: 20px;
        padding: 0px;
        margin-top: 0.5px;
        width: 100px;
    }

    .usersTable > div > span select:nth-child(3){
        width: 50px;
        border-left: 1px solid #FDFFF640;
        border-radius: 0px;
        padding-left: 5px;
    }

    .usersTable td:nth-child(1), .usersTable td:nth-child(5), .usersTable td:nth-child(8){
        min-width: 35px;
        max-width: 35px;
    }

    .usersTable td:nth-child(2), .usersTable td:nth-child(3){
      min-width: 130px;
      max-width: 130px;
    }

    .usersTable td:nth-child(7){
        min-width: 180px;
        max-width: 180px;
    }

    .usersTable td:nth-child(9){
        min-width: 100px;
        max-width: 100px;
    }
</style>