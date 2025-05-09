<?php
    echo "<nav class='adminNav'>";
    echo "<span>
            <h3>Quick Ride</h3>
        </span>
        <span>
            <span class='adminNavIndicator'></span>
            <button onclick='setActiveBtnAdmin(1)' id='overviewBtn' class='active'><img src='./images/icons/overview-icon.svg' height='16px' width='16px'>Overview</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(2)' id='vehiclesBtn'><img src='./images/icons/car-icon.svg' height='16px' width='16px'>Cars</button>
            <span class='moreVehicleSettings'>
                <!--<button onclick='setActiveAdminSettings(&#x27;vehicleStatistics&#x27;)'>Car Statistics</button>-->
                <!--<button onclick='setActiveAdminSettings(&#x27;vehicleManagement&#x27;)'>Car Management</button>-->
                <a href='#carStatistics'>Car Statistics</a>
                <a href='#carManagement'>Car Management</a>
            </span>
            <button onclick='setActiveBtnAdmin(3)' id='bookingsBtn'><img src='./images/icons/booking-icon.svg' height='16px' width='16px'>Rentals</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(4)' id='usersBtn'><img src='./images/icons/user-icon.svg' height='16px' width='16px'>Users</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(5)' id='paymentsBtn'><img src='./images/icons/payment-icon.svg' height='16px' width='16px'>Payments</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(6)' id='vouchersBtn'><img src='./images/icons/voucher-icon.svg' height='16px' width='16px'>voucher</button>
            <span></span>
            
            <button onclick='setActiveBtnAdmin(7)' id='ticketsBtn'><img src='./images/icons/ticket-icon.svg' height='16px' width='16px'>Tickets</button>
            <span></span>

            <button onclick='setActiveBtnAdmin(8)' id='logsBtn'><img src='./images/icons/logs-icon.svg' height='16px' width='16px'>Logs</button>
        </span>
        <span>
            <a href='../auth/logout.php'><img src='./images/icons/logout-icon.svg' height='16px' width='16px'>Log out</a>
        </span>";
    echo "</nav>";
    echo "<div class='adminBody'>
        <span class='adminDisplayOffset'></span>";
    echo "<section class='adminDisplay'>";

   // include_once("./panels/admin/vehicleStatistics.php");
    include_once("./panels/admin/overview.php");
    include_once("./panels/admin/carManagement.php");
    include_once("./panels/admin/userManagement.php");
    include_once("./panels/admin/payments.php");
    include_once("./panels/admin/rentals.php");
    include_once("./panels/admin/voucherManagement.php");
    include_once("./panels/admin/tickets.php");
    include_once("./panels/admin/logs.php");

    echo "</section>
        <p class='msg'>Hello World!</p>
        </div>";
?>

<script type="text/javascript">
    const overviewBtn = document.getElementById('overviewBtn');
    const vehiclesBtn = document.getElementById('vehiclesBtn');
    const bookingsBtn = document.getElementById('bookingsBtn');
    const usersBtn = document.getElementById('usersBtn');
    const paymentsBtn = document.getElementById('paymentsBtn');
    const vouchersBtn = document.getElementById('vouchersBtn')
    const ticketsBtn = document.getElementById('ticketsBtn');
    const logsBtn = document.getElementById('logsBtn');
    const adminNavIndicator = document.querySelector('.adminNavIndicator');

    //const vehicleStatistics = document.querySelector('.vehicleStatistics');
    const overview = document.querySelector('.overview');
    const carManagement = document.querySelector('.carManagement');
    const moreVehicleSettings = document.querySelector('.moreVehicleSettings');
    const userManagement = document.querySelector('.userManagement');
    const rentals = document.querySelector('.rentals');
    const payments = document.querySelector('.payments'); 
    const vouchers = document.querySelector('.voucherManagement');
    const tickets = document.querySelector('.tickets'); 
    const logs = document.querySelector('.logs');

    adminNavIndicator.style.height = overviewBtn.offsetHeight+10 +"px";
    adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
    adminNavIndicator.style.left = overviewBtn.offsetLeft-5 +"px";
    adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";

    let activeAdminNav = 1;

    function setActiveBtnAdmin(index){
        overviewBtn.classList.remove("active");
        vehiclesBtn.classList.remove("active");
        bookingsBtn.classList.remove("active");
        usersBtn.classList.remove("active");
        paymentsBtn.classList.remove("active");
        vouchersBtn.classList.remove("active");
        ticketsBtn.classList.remove("active");
        logsBtn.classList.remove("active");

        overview.classList.remove("active");
        moreVehicleSettings.classList.remove('open');
        //vehicleStatistics.classList.remove("active");
        carManagement.classList.remove("active");
        userManagement.classList.remove("active");
        payments.classList.remove("active");
        rentals.classList.remove("active");
        vouchers.classList.remove("active");
        tickets.classList.remove("active");
        logs.classList.remove("active");

        activeAdminNav = index;
        switch(index){
            case 1:
                overview.classList.add("active");

                adminNavIndicator.style.top = overviewBtn.offsetTop-5 +"px";
                overviewBtn.classList.add("active");
                adminNavIndicator.style.width = overviewBtn.offsetWidth+20 +"px";
                break;
            case 2:
                moreVehicleSettings.classList.add('open');
                carManagement.classList.add("active");
                
                adminNavIndicator.style.top = vehiclesBtn.offsetTop-5 +"px";
                vehiclesBtn.classList.add("active");
                adminNavIndicator.style.width = vehiclesBtn.offsetWidth+20 +"px";
                break;
            case 3:
                rentals.classList.add("active");

                adminNavIndicator.style.top = bookingsBtn.offsetTop-5 +"px";
                bookingsBtn.classList.add("active");
                adminNavIndicator.style.width = bookingsBtn.offsetWidth+20 +"px";
                break;
            case 4:
                userManagement.classList.add("active");
                
                adminNavIndicator.style.top = usersBtn.offsetTop-5 +"px";
                usersBtn.classList.add("active");
                adminNavIndicator.style.width = usersBtn.offsetWidth+20 +"px";
                break;
            case 5:
                payments.classList.add("active");
                
                adminNavIndicator.style.top = paymentsBtn.offsetTop-5 +"px";
                paymentsBtn.classList.add("active");
                adminNavIndicator.style.width = paymentsBtn.offsetWidth+20 +"px";
                break;
            case 6:
                vouchers.classList.add("active");
                
                adminNavIndicator.style.top = vouchersBtn.offsetTop-5 +"px";
                vouchersBtn.classList.add("active");
                adminNavIndicator.style.width = vouchersBtn.offsetWidth+20 +"px";
                break;
            case 7:
                tickets.classList.add("active");

                adminNavIndicator.style.top = ticketsBtn.offsetTop-5 +"px";
                ticketsBtn.classList.add("active");
                adminNavIndicator.style.width = ticketsBtn.offsetWidth+20 +"px";
                
                getCustomerList();
                break;
            case 8:
                logs.classList.add("active");

                adminNavIndicator.style.top = logsBtn.offsetTop-5 +"px";
                logsBtn.classList.add("active");
                adminNavIndicator.style.width = logsBtn.offsetWidth+20 +"px";
                break;
        }
    }

    /*function setActiveAdminSettings(name){
        vehicleStatistics.classList.remove("active");
        vehicleManagement.classList.remove("active");

        switch(name){
            case "vehicleStatistics":
                vehicleStatistics.classList.add("active");
                break;
            case "vehicleManagement":
                vehicleManagement.classList.add("active");
                break;
        }
    }*/
    setActiveBtnAdmin(1);
</script>
<script src="./scripts/realtime.js"></script>
<script type="text/javascript">
    socket.on('update_admin', (msg) => {
        getPaymentStat();
        filterPayments();

        getActiveRentals();
        getRentalsHistory();

        getLogs();

        getVouchers();
        console.log("Admin updated: " +msg);
    });

    socket.on('message', (msg) => {
        if(msg.includes("from_user")){
            document.querySelector(".messagingWrapper").style.width = "65%";
            document.querySelector(".userAccounts").style.width = "35%";
            
            getMessages(JSON.stringify(msg).split("|")[1], "admin");
            $(".msg").html("<p class='success'>New Message</p>");
        }
    });
</script>