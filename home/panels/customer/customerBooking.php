<?php
    echo "<div class='myBooking'>
        <span style='display: block; height: 40px; width: 100%;'></span>
        <span>
            <div class='currentBooking'>
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
                        <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p id='carFueltype'>&nbsp;E</p>
                    </span>
                    <span>
                        <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p id='carTransmission'>&nbsp;E</p>
                    </span>
                </div>
                <div class='bookingStatus' id='bookingDropOff'>
                    <span>
                        <span id='rentDropOffLocation'>
                            <p>Drop-Off Location</p>
                            <p>8912 Balilihan, Cebu, Snshasigyc</p>
                        </span>
                        <span id='rentEndTime'>
                            <p>End Time</p>
                            <p>09:00pm</p>
                        </span>
                        <span id='rentEndDate'>
                            <p>End Date</p>
                            <p>Jun 19, 2022</p>
                        </span>
                        <span id='returnDate'>
                            <p>Return Date</p>
                            <p>July 19, 2022</p>
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
    </div>";
?>

<script type="text/javascript">
    function getUserBookingHistory(){
        $.ajax({
            type: "post",
            url: "./queries/user/getBooking.php",
            data: { action: 'getCar' },
            success: function(res){
                console.log(res)
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
                console.log(res);
                $("#bookingPickUp").html(res);
            },
            error: function(error){

            }
        });
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
        overflow-y: scroll;
    }

    .myBooking > span {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
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
        margin-top: 30px;
    }

    .bookingStatus {
        background-color: #38814a;
        padding: 15px 25px;
        border-radius: 5px;
    }

    .bookingStatus > span{
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
    }

    .bookingStatus > span > span > p:first-child{
        opacity: 0.8;
        font-size: 14px;
    }

    .bookingStatus > span > span:not(:last-child){
        border-right: 1px solid #FDFFF6;
        margin-right: 30px;
        padding-right: 30px;
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
</style>