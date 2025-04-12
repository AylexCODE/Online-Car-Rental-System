<?php
    echo "<div class='rentCar'>
        <h2>Rental Form</h2>
        <button class='rentExitButton' onclick='setInitialRentInfo(0, 0, 0, 0, 0, 0, 0);'>Back</button>
        <form>
            <span>
                <span>
                    <p class='rentInfoHeader'>Location & Date</p>
                    <span>
                        <label for='startDateTime'>Start/Pick-Up Date & Time</label>
                        <input type='datetime-local' id='startDateTime' max='0' name='startDateTime' onchange='verifyDate()'>
                    </span>
                    <span>
                        <label for='endDateTime'>End/Drop-Off Date & Time</label>
                        <input type='datetime-local' id='endDateTime' max='0' name='endDate' onchange='verifyDate()' disabled='true'>
                        <p class='endDateInvalid' style='font-size: 12px; color: red; height: 0px;'></p>
                    </span>
                    <span>
                        <label for='pickupLocation'>Pick-Up Location</label>
                        <select id='pickupLocation' name='pickupLocation'>
                            <option>Balilihan</option>
                            <option>Balilihan</option>
                        </select>
                    </span>
                    <span>
                        <label for='dropOffLocation'>Drop-Off Location</label>
                        <select id='dropOffLocation' name='dropOffLocation' style='margin-bottom: 5px;'>
                            <option>Balilihan</option>
                            <option>Balilihan</option>
                        </select>
                    </span>
                </span>
                <span class='rentCarInfo'>
                    <p class='rentInfoHeader'>Car Information</p>
                    <img height='180px' width='277px' class='rentCarImg' style='border: 1px solid #E2F87B; border-radius: 5px;'>
                    <span>
                        <p style='font-size: 20px;' class='rentCarBrandModel'>Ford Ranger</p>
                        <span><span>₱&nbsp;</span><p class='rentCarPrice'>5000</p>/Day</span>
                        <span><img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'>&nbsp;<p class='rentCarFuelType'>Gasoline</p></span>
                        <span><img src='./images/icons/transmission-icon.svg' height='14px' width='14px'>&nbsp;<p class='rentCarTransmission'>Manual</p></span>
                    </span>
                </span>
            </span>
            <span>
                <span>
                    <iframe width='100%' height='200' style='border: 1px solid #E2F87B; border-radius: 10px;' loading='lazy' allowfullscreen referrerpolict='no-referrer-when-downgrade' id='map'
                        src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyDeVWNZzB23rWAxghPYc3EUKwWfLpkuzZQ
                        &origin=PXW6+572, Provincial+Road, Balilihan, Bohol&maptype=satellite&destination=QX4H+H2P, Balilihan, Bohol'>
                    </iframe>
                </span>
            </span>
            <span>
                <p>Additional Information</p>
                <span>
                    <span>
                        <label>Rental Duration</label>
                        <input type='text' id='rentDuration' disabled value='-'>
                    </span>
                    <span>
                        <label>Paid By</label>
                        <select>
                            <option id='payDaily'>Daily</option>
                            <option id='payWeekly' disabled='true'>Weekly</option>
                            <option id='payMonthly' disabled='true'>Monthly</option>
                        </select>
                    </span>
                </span>
                <label>Payment Method</label>
                <select>
                    <option>Credit/Depit Card</option>
                    <option>PayPal</option>
                    <option>GCash</option>
                    <option>Bank Transfer</option>
                    <option>Cash on Pickup</option>
                </select>
                <label>Enter Voucher (optional)</label>
                <input type='text'>
            </span>
            <span>
                <p>Fees</p>
                <label>Fuel Cost</label>
                <input type='text' disabled>
                <input type='text' disabled>
            </span>
            <p id='rentalCost'>Total Rental Cost: ₱<span>120</span></p>
        </form>
        <span class='agreementCheck'>
            <span>
                <input type='checkbox' id='agreementCheckbox'>
                <label for='agreementCheckbox'>&nbsp;I have read and agree to the <a href='./pages/agreement.php' target='_blank'><span style='text-decoration: underline;'>terms and conditions</span>.&nbsp;<img src='./images/icons/navigatePage-icon.svg' height='10px' width='10px'></a></label>
            </span>
        </span>
        <button id='rentSubmitBtn'>Submit</button>
    </div>";
?>

<script type="text/javascript">
    const startDate = document.getElementById("startDateTime");
    const now = new Date();
    let tomorrow = new Date(now.getTime() + 86400000);

    function setInitialRentInfo(carID, brandName, modelName, rentalPrice, transmission, fuelType, imgUrl){
        const homePage = document.querySelector(".homePage");
        const rentPage = document.querySelector(".rentPage");
        if(carID != 0){
            document.body.scrollTop = 0;
            document.querySelector(".rentCarBrandModel").innerHTML = `${brandName} ${modelName}`;
            document.querySelector(".rentCarPrice").innerHTML = rentalPrice;
            document.querySelector(".rentCarFuelType").innerHTML = fuelType;
            document.querySelector(".rentCarTransmission").innerHTML = transmission;
            document.querySelector(".rentCarImg").src = imgUrl;

            let minStartDate = `${tomorrow.getFullYear()}-${tomorrow.getMonth().toString().length != 1 ? (tomorrow.getMonth()+1) : "0" +(tomorrow.getMonth()+1)}-${tomorrow.getDate().toString().length != 1 ? tomorrow.getDate() : "0" +tomorrow.getDate()}T${tomorrow.getHours()}:${tomorrow.getMinutes()}`;
            
            startDate.min = minStartDate;
        }else{
            document.querySelector(".homePage").style.display = "block";
            document.querySelector(".rentPage").style.display = "none";
        }
        document.getElementById("agreementCheckbox").checked = false;
    }

    function verifyDate(){
        const endDate = document.getElementById("endDateTime");
        document.getElementById("rentDuration").value = "-";
        document.getElementById("payMonthly").disabled = true;
        document.getElementById("payWeekly").disabled = true;
        document.getElementById("payDaily").selected = true;
        if(startDate.value != ""){
            let dateOffset = new Date();

            let startDayOnly = document.getElementById("startDateTime").value.split("-");
            startDayOnly = startDayOnly[2].split("T");
            dateOffset.setDate(parseInt(startDayOnly[0]));
            dateOffset = new Date(dateOffset.getTime() + 86400000);

            
            let minEndDate = `${dateOffset.getFullYear()}-${dateOffset.getMonth().toString().length != 1 ? (dateOffset.getMonth()+1) : "0" +(dateOffset.getMonth()+1)}-${dateOffset.getDate().toString().length != 1 ? dateOffset.getDate() : "0" +dateOffset.getDate()}T${dateOffset.getHours()}:${dateOffset.getMinutes()}`;
                
            endDate.min = minEndDate;
            endDate.disabled = false;
            if(endDate.value != ""){
                const tempStartDate = Date.parse(startDate.value);
                const tempEndDate = Date.parse(endDate.value);

                const hours = Math.floor((tempEndDate - tempStartDate) / 1000 / 60 / 60); 
                if(hours < 12){
                    document.querySelector(".endDateInvalid").innerHTML = "Rent Duration is Less Than 12 Hours!";
                }else{
                    document.querySelector(".endDateInvalid").innerHTML = "";

                    if(hours >= 24){
                        const day = hours / 24;
                        if(day.toString().includes(".")){
                            document.getElementById("rentDuration").value = `${day.toFixed(0)} ${day > 1 ? 'Days' : 'Day'} ${(hours % 24).toFixed(0)} ${hours % 24 > 1 ? 'Hours' : 'Hour'}`;
                        }else{
                            document.getElementById("rentDuration").value = `${day.toFixed(0)} ${day > 1 ? 'Days' : 'Day'}`;
                        }
                    }else{
                        document.getElementById("rentDuration").value = hours + " Hours";
                    }
                }
                
                if(hours / 24 >= 7){
                    document.getElementById("payWeekly").disabled = false;
                    if(hours / 24 / 30 >= 1){
                        document.getElementById("payMonthly").disabled = false;
                    }else{
                        document.getElementById("payMonthly").disabled = true;
                        document.getElementById("payWeekly").selected = true;
                    }
                }
            }
        }else{
            endDate.disabled = true;
            endDate.value = "";
        }
    }

    document.getElementById("agreementCheckbox").addEventListener('change', (e) => { if(e.target.checked == true)window.open("./pages/agreement.php", "_blank") });
</script>

<style type="text/css">
    .rentCar, .rentCar > form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .rentCar > h2 {
        font-size: 28px;
        margin-top: 15px;
    }

    .rentCar .rentInfoHeader {
        text-align: center;
        margin-bottom: 5px;
    }

    .rentCar > form {
        padding: 5px 30px;
        border-radius: 10px;
        display: block;
        transform: translateY(-40px);
    }

    .rentCar > form > span:first-child, .rentCar > form > span:nth-child(3) > span {
        display: flex;
        flex-direction: row;
        gap: 40px;
    }

    .rentCar > form > span:nth-child(3) > span {
        gap: 10px;
    }

    .rentCar > form > span:first-child > span:first-child, .rentCar > form > span:first-child > span:first-child > span, .rentCar > form > span:nth-child(3) > span > span {
        display: flex;
        flex-direction: column;
    }

    .rentCar > form > span:first-child > span:first-child {
        justify-content: space-between;
    }

    .rentCar input {
        padding-inline: 2.5px;
    }

    .rentCar input, .rentCar select {
        background-color: transparent;
        outline: none;
        border: none;
        color: #FDFFF6;
        height: 28px;
        border-bottom: 1px solid #FDFFF6;
        margin-top: 10px;
    }

    .rentCar input::-webkit-calendar-picker-indicator{
        filter: invert();
    }

    .rentCar select * {
        background-color: #031A09;
    }

    .rentCar select, .rentCar label, .rentCar h2, .rentCar p {
        color: #FDFFF6;
    }

    .rentCar label {
        font-size: 14px;
        opacity: 0.8;
        transform: translateY(10px);
    }

    .rentCarInfo {
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .rentCarInfo > span > span {
        color: #FDFFF6;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .rentCarInfo > span > span > p {
        font-size: 14px;
    }

    .rentCar > form > span:nth-child(2){
        display: block;
        margin-top: 10px;
    }

    .rentCar > form > span:nth-child(3), .rentCar > form > span:nth-child(4){
        margin-top: 10px;
        display: flex;
        flex-direction: column;
    }
    
    .rentCar > form > span:first-child, .rentCar > form > span:nth-child(3), .rentCar > form > span:nth-child(4) {
        border: 2px solid #E2F87B;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .rentCar > form > span:nth-child(3) > p:nth-child(1),  .rentCar > form > span:nth-child(4) > p:nth-child(1) {
        font-weight: bold;
    }

    .rentCar input[disabled]{
        opacity: 0.8;
    }

    #rentalCost {
        margin-top: 5px;
        font-style: italic;
    }

    .agreementCheck {
        display: flex;
        flex-direction: row;
        align-items: center;
        height: 0px;
        transform: translateY(-40px);
    }

    .agreementCheck > span > label {
        font-size: 16px;
        opacity: 1;
    }

    .agreementCheck > span > label > a, .agreementCheck > span > label > a:visited {
        color: #FDFFF6;
        text-decoration: none;
    }

    .agreementCheck > span > input {
        transform: translateY(8px);
    }

    .rentCar > #rentSubmitBtn, .rentExitButton {
        outline: none;
        border: none;
        border-radius: 5px;
        background-color: #E2F87B;
        color: #031A09;
        padding: 5px 30px;
        transform: translateY(-20px);
    }

    .rentExitButton {
        position: sticky;
        top: 54px;
        right: 1%;
        align-self: flex-end;
        z-index: 999;
        cursor: pointer;
        background-color: transparent;
        border: 1px solid #E2F87B;
        color: #FDFFF6;
        transform: translateY(-40px);
    }

    @media only screen and (max-width: 992px) {
        .rentCar > form > span:first-child, .rentCar > form > span:nth-child(3) > span {
            flex-direction: column-reverse;
            gap: 20px;
        }

        .rentCar .rentCarImg {
            scale: 0.9;
            align-self: center;
        }

        .rentCar .rentInfoHeader {
            align-self: flex-start;
        }
        
        .rentCarInfo {
            align-items: center;
        }

        .rentCarInfo .rentInfoHeader {
            align-self: center;
        }

        .rentCar > form, .agreementCheck {
            width: 85%;
        }

        .agreementCheck {
            margin-block: 10px 30px;
            justify-content: center;
        }

        .rentExitButton {
            padding: 5px 20px;
        }
    }
</style>