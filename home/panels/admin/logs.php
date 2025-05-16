<?php
  echo "<div class='logs'>
          <h4>Logs</h4>
          <span id='backupRestoreWrapper'>
              <button onclick='backupRestore(&#x27;start&#x27;);'>Start</button>
              <button onclick='backupRestore(&#x27;backup&#x27;);'>Backup</button>
              <button onclick='backupRestore(&#x27;restore&#x27;);'>Restore</button>
          </span>
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
                            <td><input type='number' id='logsFilterNo' oninput='getLogs();'></td>
                            <td><input type='search' id='logsFilterUser' oninput='getLogs();'></td>
                            <td>
                                <select id='logsFilterRole' onchange='getLogs();'>
                                    <option value=''>Any</option>
                                    <option value='Customer'>Customer</option>
                                    <option value='Admin'>Admin</option>
                                </select>
                            </td>
                            <td><input type='date' id='logsFilterDate' onchange='getLogs();'></td>
                            <td><input type='search' id='logsFilterActivity' oninput='getLogs();'></td>
                        </tr>
                        <tbody id='recentLogs'></tbody>
                    </table>
                </span>
            </span>
          </span>
    </div>";
?>

<script type="text/javascript">
    const logsFilterNo = document.getElementById("logsFilterNo");
    const logsFilterUser = document.getElementById("logsFilterUser");
    const logsFilterRole = document.getElementById("logsFilterRole");
    const logsFilteDate = document.getElementById("logsFilterDate");
    const logsFilterActivity = document.getElementById("logsFilterActivity");

    function getLogs(){
        $.ajax({
            type: 'post',
            url: './queries/get_logs.php',
            data: { logsFilterNo: logsFilterNo.value, logsFilterUser: logsFilterUser.value, logsFilterRole: logsFilterRole.value, logsFilterDate: logsFilterDate.value, logsFilterActivity: logsFilterActivity.value },
            success: function(res){
                $("#recentLogs").html(res);
            },
            error: function(){}
        });
    }
    
    function backupRestore(mode){
        $.ajax({
            type: 'post',
            url: './queries/backupRestore.php',
            data: { type: mode },
            success: function(res){
                let message = "Backup";
                if(mode == "restore"){
                    message = "Restore";
                }else if(mode == "start"){
                    message = "Start Backup"
                }
                console.log(res)
                if(res == "Ok"){
                    $(".msg").html(`<p class='success'>${message} Successful</p>`);
                }else{
                    $(".msg").html(`<p class='error'>${message} Error</p>`);
                }
            },
            error: function(){}
        });
    }

    getLogs();  
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
        height: calc(100% - 125px);
        display: block;
    }

    .logs > span:nth-child(2) {
        height: fit-content;
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
    
    .logs th:nth-child(5), .logs td:nth-child(5) {
        min-width: 460px;
        max-width: 460px;
        overflow-x: scroll;
    }
    
    #backupRestoreWrapper {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
    
    #backupRestoreWrapper > button {
        background-color: #316C40;
        padding: 10px 20px;
        color: #FDFFF6;
        border: none;
        height: fit-content;
        border-radius: 5px;
    }
</style>