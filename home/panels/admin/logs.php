<?php
  echo "<div class='logs'>
          <h4>Logs</h4>
          <span>
            <span>
                <span>
                    <p>Recent</p>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Date & Time</th>
                            <th>Activity</th>
                        </thead>
                        <tr class='logsSearchBar'>
                            <td><input type='number' id='logsFilterNo' oninput=''></td>
                            <td><input type='search' id='logsFilterUser' oninput=''></td>
                            <td>
                                <select id='logsFilterRole' onchange=''>
                                    <option value=''>Any</option>
                                    <option value='Customer'>Customer</option>
                                    <option value='Admin'>Admin</option>
                                </td>
                            <td><input type='date' id='logsFilterDate' oninput=''></td>
                            <td><input list='logsFilter' id='logsFilterActivity' onchange=''>
                            <datalist id='logsFilter' onchange=''>
                                <option value=''>All</option>
                                <option value=''>Log in</option>
                                <option value=''>Sign up</option>
                                <option value=''>Rent</option>
                                <option value=''>Rent</option>
                            </datalist></td>
                        </tr>
                        <tbody id='recentLogs'>";
                        $k = 1;
                        while($k <15){
                            echo "<tr>
                                    <td>$k</td>
                                    <td>Lex</td>
                                    <td>Admin</td>
                                    <td>2025-10-23 12:34:40</td>
                                    <td>Login</td>
                                </tr>";
                            $k++;
                        }
                        echo "</tbody>
                    </table>
                </span>
            </span>
          </span>
    </div>";
?>

<script type="text/javascript">
    
</script>

<style type="text/css">
    .logs {
        height: 100%;
        width: 100%;
        display: none;
        overflow-y: scroll;
    }
    
    .logs > span {
        padding: 0px 25px;
        height: calc(100% - 75px);
        display: block;
    }
    
    .logs > span > span {
        display: block;
        height: 100%;
        width: 100%;
        padding-bottom: 10px;
    }
    
    .logs > span > span > span {
        display: block;
        background-color: #316C40;
        height: 100%;
        width: 100%;
        overflow: scroll;
        padding: 0px 20px 15px 20px;
        border-radius: 5px;
    }

    .logs > span > span > span > p {
        width: 100%;
        text-align: left;
        font-size: 20px;
        position: sticky;
        top: 0px;
        background-color: #316C40;
        padding-block: 15px;
        outline: 1px solid #316C40;
    }

    .logs > span > span > span > table {
        width: 100%;
        text-align: left;
        color: #FDFFF6;
        font-weight: normal;
        font-family: space-grotesk-semibold;
        text-wrap: nowrap;
    }

    .logs th {
        border-bottom: 1px solid #E2F87B;
        outline: 1px solid #316C40;
        position: sticky;
        padding: 5px 10px;
        top: 56px;
        background-color: #316C40;
    }

    .logs tr:nth-child(even){
        background-color: #38814a;
    }
    
    .logs tr:nth-child(odd) td {
        padding: 20px 10px;
        outline: 1px solid #316C40;
    }

    .logs td {
        padding: 20px 10px;
        outline: 1px solid #38814a;
        overflow-x: scroll;
    }

    .logsSearchBar {
        position: sticky;
        top: 88px;
        background-color: #316C40;
    }

    .logsSearchBar > td {
        border-bottom: 1px solid #E2F87B70;
        padding: 0px 0px;
    }

    .logs > span > span > span > table input, .logs > span > span > span > table select {
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

    .logs > span > span > span > table input::-webkit-search-cancel-button {
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

    .logs > span > span > span > table input::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .logs > span > span > span > table select {
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

    .logs tr > td:last-child{
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .logs tr:not(:first-child) > td:last-child > button {
        padding: 5px 2.5px;
        outline: none;
        border: 1px solid #076d0d;
        border-radius: 5px;
        background-color: #00b809;
        color: #FDFFF6;
    }

    .logs tr:not(:first-child) > td:last-child > button:last-child {
        border-color: #b10303;
        background-color: #ff2323;
    }

    .logs th:first-child, .logs td:first-child {
        min-width: 80px;
        max-width: 80px;
    }

    .logs th:nth-child(2), .logs td:nth-child(2) {
        min-width: 150px;
        max-width: 150px;
    }

    .logs th:nth-child(3), .logs td:nth-child(3) {
        min-width: 110px;
        max-width: 110px;
    }

    .logs th:nth-child(4), .logs td:nth-child(4) {
        min-width: 190px;
        max-width: 190px;
    }
</style>