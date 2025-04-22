<?php
    echo "<div class='userManagement'>
            <h4>User Management & Statistics</h4>
            <span>
                <span>
                    <span class='usersTable'>
                        <p>Users (12 Total)</p>
                        <table>
                            <thead>
                                <th>UID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No.</th>
                                <th>Age</th>
                                <th>Driver's License</th>
                                <th>Registered Date</th>
                            </thead>
                            <tr class='usersFilter'>
                                <td><input type='number'></td>
                                <td><input type='search'></td>
                                <td><input type='number'></td>
                                <td><input type='search'></td>
                                <td><input type='number'></td>
                                <td><input type='search'></td>
                                <td><input type='date'></td>
                            </tr>
                            <tbody>";
                            $l = 0;
                            while($l < 15){
                                echo "<tr>
                                    <td>1</td>
                                    <td>Ley</td>
                                    <td>ley@gmail.com</td>
                                    <td>09218912341</td>
                                    <td>19</td>
                                    <td>174-76-934164</td>
                                    <td>2025-10-23</td>
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

    .usersTable > p {
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: #316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
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
        top: 56px;
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
        top: 88px;
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
        padding: 0px 10px;
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

    .usersTable > table select {
        -wekbit-appearance: none;
        appearance: none;
        text-align: center;
        padding: 5px 2.5px;
    }

    .usersFilter td:nth-child(3) {
        max-width: 100px;
        min-width: 100px;
    }

    .usersFilter td:nth-child(7) {
        max-width: 240px;
        min-width: 240px;
    }
</style>