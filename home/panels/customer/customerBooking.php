<?php
    echo "<div class='myBooking'>
        <span>
            <div class='currentBooking'>
                <span style='display: block; height: 40px; width: 100%;'></span>
                <h4>Current Booking</h4>
                <div class='bookingStatus' id='bookingPickUp'>
                    <span>
                        <span id='rentPickupLocation'>
                            <p>Pick-Up Location</p>
                            <p></p>
                        </span>
                        <span id='rentStartTime'>
                            <p>Pick-Up Time</p>
                            <p></p>
                        </span>
                        <span id='rentStartDate'>
                            <p>Pick-Up Date</p>
                            <p></p>
                        </span>
                        <span id='rentAmountPaid'>
                            <p>Amount Paid</p>
                            <p></p>
                        </span>
                        <span id='rentPaymentFrequency'>
                            <p>Payment Frequency</p>
                            <p></p>
                        </span>
                    </span>
                </div>
                <div id='rentCarInfo'>
                    <img src='./images/cars/ford.png' height='180px' width='277px'>
                    <p class='carBookingName'>Ford</p>
                    <span>
                        <span>
                            <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p id='carFueltype'>&nbsp;E</p>
                        </span>
                        <span>
                            <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p id='carTransmission'>&nbsp;E</p>
                        </span>
                    </span>
                </div>
                <div class='bookingStatus' id='bookingDropOff'>
                    <span>
                        <span id='rentDropOffLocation'>
                            <p>Drop-Off Location</p>
                            <p></p>
                        </span>
                        <span id='rentEndTime'>
                            <p>Return Time</p>
                            <p></p>
                        </span>
                        <span id='returnDate'>
                            <p>Return Date</p>
                            <p></p>
                        </span>
                    </span>
                </div>
            </div>
            <div class='bookingHistory'>
                <h4>Booking History</h4>
                <span>
                    <table>
                        <thead>
                            <th>No.</th>
                            <th>Car</th>
                            <th>Start DateTime</th>
                            <th>End DateTime</th>
                            <th>Duration</th>
                            <th>Amount Paid</th>
                            <th>Payment Frequency</th>
                            <th>Status</th>
                        </thead>
                        <tbody id='bookingHistoryRow'>
                        </tbody>
                    </table>
                </span>
            </div>
        </span>
        <span class='carConditionCover' onclick='retrieveBookedCar(&#x27;None&#x27;, &#x27;None&#x27;, &#x27;hide&#x27;);' style='display: none;'></span>
        <div id='carCondition'>
            <span>
                <button style='position: relative; background-color: transparent; left: 54%; top: -10px; outline: none; border: none; color: #E2F87B; font-size: 24px; height: 5px;' onclick='retrieveBookedCar(&#x27;None&#x27;, &#x27;None&#x27;, &#x27;hide&#x27;);'>&#215;</button>
                <h4 style='margin-bottom: 5px;'>Car Condition</h4>
                <span id='carConditionIndicator'></span>
                <button onclick='retrieveBookedCar(document.getElementById(&#x27;carCondition&#x27;).className, &#x27;None&#x27;, &#x27;confirm&#x27;);'>Confirm</button>
            </span>
        </div>

        <span class='carConditionReturnCover' onclick='returnBookedCar(&#x27;None&#x27;, &#x27;None&#x27;, &#x27;hide&#x27;);' style='display: none;'></span>
        <div id='carConditionReturn'>
            <span>
                <button style='position: relative; background-color: transparent; left: 54%; top: -10px; outline: none; border: none; color: #E2F87B; font-size: 24px; height: 5px;' onclick='returnBookedCar(&#x27;None&#x27;, &#x27;None&#x27;, &#x27;hide&#x27;);'>&#215;</button>
                <h4 style='margin-bottom: 5px;'>Car Condition</h4>
                <span id='carConditionIndicatorReturn'>
                    <p>Damages:</p>
                    <span><input type='checkbox' id='returnDents' onchange='updateDamages(&#x27;dents&#x27;)'><label for='returnDents'>Dents <span class='dentsCost'></span></label></span>
                    <span><input type='checkbox' id='returnScratches'  onchange='updateDamages(&#x27;scratches&#x27;)'><label for='returnScratches'>Scratches <span class='scratchesCost'></span></label></span>
                    <span><input type='checkbox' id='returnChippedPaint'  onchange='updateDamages(&#x27;chippedPaint&#x27;)'><label for='returnChippedPaint'>Chipped Paint <span class='chippedPaintCost'></span></label></span>
                    <span><input type='checkbox' id='returnCrackedWindshields'  onchange='updateDamages(&#x27;cWS&#x27;)'><label for='returnCrackedWindshields'>Cracked Windshields <span class='crackedWindshieldsCost'></span></label></span>
                </span>
                <span>
                    <p>Car Damage Penalty:&nbsp;₱<span id='carDmgPenalty'>0</span></p>
                </span>
                <p>Late Return Penalty:&nbsp;₱<span id='lateReturnPenalty'>0</span></p>
                <button onclick='returnBookedCar(document.getElementById(&#x27;carConditionReturn&#x27;).className.split(&#x27;|&#x27;)[0], document.getElementById(&#x27;carConditionReturn&#x27;).className.split(&#x27;|&#x27;)[1], &#x27;confirm&#x27;);'>Confirm</button>
            </span>
        </div>
    </div>";
?>

<script type="text/javascript">
    const lateReturnCostHour = 50;
    const dentsCost = 1900;
    const scratchesCost = 1000;
    const chippedPaintCost = 4000;
    const crackedWindshieldsCost = 10000;
    let totalDamageCost = 0;

    function getUserBookingHistory(){
        $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getCar' },
            success: function(res){
                $("#rentCarInfo").html(res);
            },
            error: function(error){

            }
        });

        $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getHistory' },
            success: function(res){
                $("#bookingHistoryRow").html(res);
            },
            error: function(error){
                
            }
        });

        $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getBookingPickUp' },
            success: function(res){
                $("#bookingPickUp").html(res);
            },
            error: function(error){

            }
        });

        $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getBookingDropOff' },
            success: function(res){
                $("#bookingDropOff").html(res);
            },
            error: function(error){

            }
        });
    }

    function retrieveBookedCar(rentalID, carID, action){
        $("#carCondition").css('display', 'none');
        $(".carConditionCover").css('display', 'none');

        if(action == "show"){
            $("#carCondition").css('display', 'flex');
            $(".carConditionCover").css('display', 'flex');
            document.getElementById("carCondition").classList.add(rentalID);

            $.ajax({
                type: "post",
                url: "./queries/car/getCarCondition.php",
                data: { carID: carID },
                success: function(res){
                    $("#carConditionIndicator").html(res);
                },
                error: function(error){
    
                }
            });
        }else if(action == "confirm"){
            $.ajax({
                type: "post",
                url: "./queries/rent/retrieveBookedCar.php",
                data: { RentalID: rentalID },
                success: function(res){
                    getUserBookingHistory();
                },
                error: function(error){
    
                }
            });
        }
    }

    function returnBookedCar(rentalID, carID, action){
        $("#carConditionReturn").css('display', 'none');
        $(".carConditionReturnCover").css('display', 'none');

        if(action == "show"){
            $("#carConditionReturn").css('display', 'flex');
            $(".carConditionReturnCover").css('display', 'flex');
            document.getElementById("carConditionReturn").classList.add(rentalID +"|" +carID);

            if(document.getElementById("lateReturnHours")){
                $("#lateReturnPenalty").html($("#lateReturnHours").html() * lateReturnCostHour);
            }
        }else if(action == "confirm"){
            const returnDents = document.getElementById("returnDents").checked == true ? 1 : 0 ;
            const returnScratches = document.getElementById("returnScratches").checked == true ? 1 : 0 ;
            const returnChippedPaint = document.getElementById("returnChippedPaint").checked == true ? 1 : 0 ;
            const returnCrackedWindshields = document.getElementById("returnCrackedWindshields").checked == true ? 1 : 0 ;

            $.ajax({
                type: "post",
                url: "./queries/rent/returnBookedCar.php",
                data: { RentalID: rentalID, CarID: carID, dents: returnDents, scratches: returnScratches, chippedPaint: returnChippedPaint, crackedWindshields: returnCrackedWindshields },
                success: function(res){
                    getUserBookingHistory();
                },
                error: function(error){
    
                }
            });
        }
    }

    function updateDamages(type){
        const returnDents = document.getElementById("returnDents").checked == true ? 1 : 0 ;
        const returnScratches = document.getElementById("returnScratches").checked == true ? 1 : 0 ;
        const returnChippedPaint = document.getElementById("returnChippedPaint").checked == true ? 1 : 0 ;
        const returnCrackedWindshields = document.getElementById("returnCrackedWindshields").checked == true ? 1 : 0 ;

        switch(type){
            case "dents":
                document.querySelector(".dentsCost").innerHTML = "";
                if(returnDents == 1){
                    totalDamageCost += dentsCost;
                    document.querySelector(".dentsCost").innerHTML = `( ₱${dentsCost} )`;
                }else{
                    totalDamageCost -= dentsCost;
                }
                break;
            case "scratches":
                document.querySelector(".scratchesCost").innerHTML = "";
                if(returnScratches == 1){
                    totalDamageCost += scratchesCost;
                    document.querySelector(".scratchesCost").innerHTML = `( ₱${scratchesCost} )`;
                }else{
                    totalDamageCost -= scratchesCost;
                }
                break;
            case "chippedPaint":
                document.querySelector(".chippedPaintCost").innerHTML = "";
                if(returnChippedPaint == 1){
                    totalDamageCost += chippedPaintCost;
                    document.querySelector(".chippedPaintCost").innerHTML = `( ₱${chippedPaintCost} )`;
                }else{
                    totalDamageCost -= chippedPaintCost;
                }
                break;
            case "cWS":
                document.querySelector(".crackedWindshieldsCost").innerHTML = "";
                if(returnCrackedWindshields == 1){
                    totalDamageCost += crackedWindshieldsCost;
                    document.querySelector(".crackedWindshieldsCost").innerHTML = `( ₱${crackedWindshieldsCost} )`;
                }else{
                    totalDamageCost -= crackedWindshieldsCost;
                }
                break;
        }

        document.getElementById("carDmgPenalty").innerHTML = totalDamageCost;
    }

    getUserBookingHistory();
</script>

<style type="text/css">
    @font-face{
        font-family: space-grotesk-semibold;
        url: ("../fonts/SpaceGrotesk-SemiBold.otf");
        src: url("../fonts/SpaceGrotesk-SemiBold.otf");
    }
    .myBooking {
        height: 100vh;
        width: 100vw;
        background-color: #316C40;
        display: none;
        color: #FDFFF6;
        overflow: hidden;
    }

    .myBooking > span {
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
    }

    .myBooking h4 {
        margin-top: 5px;
        font-size: 24px;
    }

    .currentBooking, .bookingHistory {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 80%;
    }

    .carBookingName {
        font-size: 20px;
    }

    .bookingHistory {
        margin-block: 25px;
    }

    .bookingStatus {
        background-color: #38814a;
        padding: 15px 25px;
        border-radius: 5px;
    }

    .bookingStatus > span {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        overflow-x: scroll;
    }
    
    .bookingStatus > span > span > span > p {
        text-wrap: nowrap;
    }
    
    .bookingStatus > span > span > span > p:first-child{
        opacity: 0.8;
        font-size: 14px;
    }

    .bookingStatus > span > span > span {
        padding-inline: 20px;
    }

    
    .bookingStatus > span > span:not(:last-child){
        border-right: 1px solid #FDFFF6;
    }
    
    .bookingStatus > span > span {
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-grow: 1;
    }

    #rentCarInfo, #rentCarInfo > span {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }
    
    #rentCarInfo {
        gap: 5px;
        flex-direction: column;
    }
    
    #rentCarInfo > span {
        flex-direction: column;
    }

    #rentCarInfo > span > span {
        display: flex;
        flex-direction: row;
        align-self: flex-start;
        align-items: center;
    }

    .bookingHistory > span {
        height: 530px;
        border-radius: 5px;
        overflow-y: scroll;
        border: 1px solid #FDFFF6;
    }

    .bookingHistory > span > table {
        background-color: #316C40;
        color: #FDFFF6;
        border-collapse: collapse;
        width: 100%;
    }

    .bookingHistory > span > table th{
        position: sticky;
        top: 0px;
        text-align: left;
        padding: 15px 10px;
        font-family: space-grotesk-semibold;
        border-bottom: 1px solid #FDFFF690;
        background-color: #295234;
        border: 1px solid #FDFFF650;
        border-top: none;
    }

    .bookingHistory > span > table tr:nth-child(odd){
        background-color: #38814a;
    }

    .bookingHistory > span > table td{
        border: 1px solid #FDFFF650;
        padding: 20px 10px;
    }

    .bookingHistory > span > table tr:hover{
        background-color: #499e5e;
    }

    .bookingWaitApproval, .bookingCancelled {
        background-color: #E2F87B;
        padding-inline: 5px;
        border-radius: 5px;
        color: #316C40;
        padding-bottom: 1.5px;
    }
    
    .bookingCancelled {
        color: #E2F87B;
        background-color: #ff5757;
    }

    .bookingWaitApproval svg, .bookingCancelled svg {
        height: 14px;
        width: 14px;
    }

    .bookingActions {
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .bookingActions > button {
        padding: 5px 10px;
        outline: none;
        border: 1px solid #E2F87B;
        background-color: #38814a;
        color: #FDFFF6;
        border-radius: 5px;
    }

    .bookingActions > button[disabled]{
        opacity: 0.8;
    }

    .bookingActions > button:last-child {
        background-color: #E2F87B;
        color: #295234;
    }

    .myBooking > span:nth-child(1){
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
        height: 100%;
    }

    .myBooking > span:nth-child(1) > div{
        scroll-snap-align: start;
    }

    #carCondition, #carConditionReturn {
        position: absolute;
        top: 0px; left: 0px;
        display: none;
        height: 100%;
        width: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        pointer-events: none;
        z-index: 100;
    }

    .carConditionCover, .carConditionReturnCover {
        position: absolute;
        top: 0px; left: 0px;
        height: 100%;
        width: 100%;
        background-color: #031A0950;
        display: none;
    }

    #carCondition > span, #carConditionReturn > span {
        background-color: #316C40;
        border: 1px solid #E2F87B;
        border-radius: 5px;
        padding: 10px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        pointer-events: all;
        min-width: 25%;
        max-width: fit-content;
    }

    #carCondition > span button, #carConditionReturn > span button {
        background-color: #E2F87B;
        border-radius: 5px;
        outline: none;
        border: none;
        padding: 5px 10px;
        margin-bottom: 10px;
        color: #295234;
    }

    #carCondition > span > button, #carConditionReturn > span > button {
        margin-top: -4px;
    }

    #carConditionReturn > span > p:nth-child(5){
        margin-bottom: 15px;
        width: 100%;
    }

    #carConditionReturn > span > span:nth-child(4) {
        margin-bottom: 5px;
    }
    
    #carConditionIndicator, #carConditionIndicatorReturn, #carConditionReturn > span > span:nth-child(4) {
        width: 100%;
    }

    #carConditionIndicatorReturn {
        margin-bottom: 10px;
    }

    #carConditionIndicatorReturn > span {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 5px;
        margin-bottom: 5px;
    }

    #carConditionIndicator > p, #carConditionIndicatorReturn > p {
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
</style>