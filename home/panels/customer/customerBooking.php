<?php
    echo "<div class='myBooking'>
        <div class='currentBooking'>
            <h4>Current Booking</h4>
            <div class='bookingStatus'>
                <span>
                    <span id='rentPickupLocation'>
                        <p>Pick-Up Location</p>
                        <p>8912 Balilihan, Cebu, Snshasigyc</p>
                    </span>
                    <span id='rentStartTime'>
                        <p>Pick-Up Time</p>
                        <p>09:00pm</p>
                    </span>
                    <span id='rentStartDate'>
                        <p>Pick-Up Date</p>
                        <p>Jun 19, 2022</p>
                    </span>
                    <span id='rentAmountPaid'>
                        <p>Amount Paid</p>
                        <p>$1290</p>
                    </span>
                    <span id='rentPaymentFrequency'>
                        <p>Payment Frequency</p>
                        <p>Daily</p>
                    </span>
                </span>
            </div>
            <div class='rentCarInfo'>
                <img src='./images/cars/ford.png' height='180px' width='277px'>
                <span>
                    <img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'><p id='carFueltype'>E</p>
                </span>
                <span>
                    <img src='./images/icons/transmission-icon.svg' height='14px' width='14px'><p id='carTransmission'>E</p>
                </span>
                <span>
                    <img src='./images/icons/availability-icon.svg' height='14px' width='14px'><p id='availabilityStatus'>E</p>
                </span>
            </div>
            <div class='bookingStatus'>
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
        </div>
    </div>";
?>

<style type="text/css">
    .myBooking {
        position: fixed;
        top: 0; left: 0;
        height: 100%;
        width: 100%;
        z-index: 90;
        background-color: #316C40;
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #FDFFF6;
    }

    .myBooking h4 {
        font-size: 24px;
    }

    .currentBooking {
        margin-top: 40px;
    }

    .currentBooking, .bookingHistory {
        display: flex;
        flex-direction: column;
        gap: 10px;
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

    .rentCarInfo {
        align-items: center;
    }

    .rentCarInfo > span {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
</style>