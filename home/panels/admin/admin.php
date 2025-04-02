<?php
    echo "<nav class='adminNav'>";
    echo "<span>
            <h3>Quick Ride</h3>
        </span>
        <span>
            <span class='adminNavIndicator'></span>
            <button onclick='setActiveBtnAdmin(1)' id='overviewBtn' class='active'><img src='./images/icons/overview-icon.svg' height='16px' width='16px'>Overview</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(2)' id='vehiclesBtn'><img src='./images/icons/car-icon.svg' height='16px' width='16px'>Vehicles</button>
            <span class='moreVehicleSettings'>
                <button onclick='setActiveAdminSettings(&#x27;vehicleStatistics&#x27;)'>Vehicle Statistics</button>
                <button onclick='setActiveAdminSettings(&#x27;vehicleManagement&#x27;)'>Vehicle Management</button>
            </span>
            <button onclick='setActiveBtnAdmin(3)' id='bookingsBtn'><img src='./images/icons/booking-icon.svg' height='16px' width='16px'>Bookings</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(4)' id='usersBtn'><img src='./images/icons/user-icon.svg' height='16px' width='16px'>Users</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(5)' id='ticketsBtn'><img src='./images/icons/ticket-icon.svg' height='16px' width='16px'>Tickets</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(6)' id='logsBtn'><img src='./images/icons/logs-icon.svg' height='16px' width='16px'>Logs</button>
        </span>
        <span>
            <a href='../auth/logout.php'><img src='./images/icons/logout-icon.svg' height='16px' width='16px'>Log out</a>
        </span>";
    echo "</nav>";
    echo "<div class='adminBody'>
        <span class='adminDisplayOffset'></span>";
    echo "<section class='adminDisplay'>";

    include_once("./panels/admin/vehicleStatistics.php");
    include_once("./panels/admin/vehicleManagement.php");

    echo "</section>
        </div>";
?>