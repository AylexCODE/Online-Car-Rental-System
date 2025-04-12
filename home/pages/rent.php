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
                        <label for='pickUpLocation'>Pick-Up Location</label>
                        <select id='pickUpLocation' name='pickUpLocation'>
                            <option value='Balilihan|5km'>Balilihan</option>
                            <option value='Catigbian|9km'>Catigbian</option>
                        </select>
                    </span>
                    <span>
                        <label for='dropOffLocation'>Drop-Off Location</label>
                        <select id='dropOffLocation' name='dropOffLocation' style='margin-bottom: 5px;'>
                            <option value='Balilihan|5km'>Balilihan</option>
                            <option value='Catigbian|9km'>Catigbian</option>
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
                            <option value='' id='invalidPay' disabled></option>
                            <option value='Daily' id='payDaily' disabled='true'>Daily</option>
                            <option value='Weekly' id='payWeekly' disabled='true'>Weekly</option>
                            <option value='Monthly' id='payMonthly' disabled='true'>Monthly</option>
                        </select>
                    </span>
                </span>
                <label>Payment Method</label>
                <select id='paymentMethod'>
                    <option value=''></option>
                    <option value='Credit/Debit Card'>Credit/Debit Card</option>
                    <option value='PayPal'>PayPal</option>
                    <option value='GCash'>GCash</option>
                    <option value='Bank Transfer'>Bank Transfer</option>
                    <option value='Cash-On-Pickup'>Cash-On-Pickup</option>
                </select>
                <label>Enter Voucher (optional)</label>
                <input type='text' id='voucher'>
            </span>
            <span>
                <p>Fees</p>
                <label>Fuel Cost</label>
                <input type='text' id='pickUpFuelCost' Value='Pick-Up Cost ₱-, -km' disabled>
                <input type='text' id='dropOffFuelCost' Value='Drop-Off Cost ₱-, -km' disabled>
            </span>
            <p id='rentalCost'>Total Rental Cost: ₱<span id='amountPaid'>-</span></p>
        </form>
        <span class='agreementCheck'>
            <span>
                <input type='checkbox' id='agreementCheckbox'>
                <label for='agreementCheckbox'>&nbsp;I have read and agree to the <a href='./pages/agreement.php' target='_blank'><span style='text-decoration: underline;'>terms and conditions</span>.&nbsp;<img src='./images/icons/navigatePage-icon.svg' height='10px' width='10px'></a></label>
            </span>
        </span>
        <button id='rentSubmitBtn' onclick='verifyForm()'>Submit</button>
    </div>";
?>

<script type="text/javascript">
    const now = new Date();
    let tomorrow = new Date(now.getTime() + 86400000);
    const startDate = document.getElementById("startDateTime");
    const endDate = document.getElementById("endDateTime");

    const pickUpLocation = document.getElementById("pickUpLocation");
    const dropOffLocation = document.getElementById("dropOffLocation");
    let startDateTime, endDateTime, rentDuration, initialRentPrice, pickUpCost, dropOffUpCost;
    const paymentMethod = document.getElementById("paymentMethod");
    const amountPaid = document.getElementById("amountPaid");
    let voucher = document.getElementById("voucher");

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

            let minStartDate = `${tomorrow.getFullYear()}-${tomorrow.getMonth().toString().length != 1 ? (tomorrow.getMonth()+1) : "0" +(tomorrow.getMonth()+1)}-${tomorrow.getDate().toString().length != 1 ? tomorrow.getDate() : "0" +tomorrow.getDate()}T${tomorrow.getHours().toString().length != 1 ? tomorrow.getHours() : "0" +tomorrow.getHours()}:${tomorrow.getMinutes().toString().length != 1 ? tomorrow.getMinutes() : "0" +tomorrow.getMinutes()}`;
            
            startDate.min = minStartDate;
        }else{
            document.querySelector(".homePage").style.display = "block";
            document.querySelector(".rentPage").style.display = "none";
        }
        const pickUpKm = document.getElementById("pickUpLocation").value;
        pickUpCost = pickUpKm.split("|")[1].substr(0, pickUpKm.split("|")[1].length-2) * 5;
        
        const dropOffKm = document.getElementById("dropOffLocation").value;
        dropOffUpCost = dropOffKm.split("|")[1].substr(0, dropOffKm.split("|")[1].length-2) * 5;
        
        document.getElementById("pickUpFuelCost").value = `Pick-Up Cost ( ${pickUpKm.split("|")[1]} ) ₱${pickUpCost}`;
        document.getElementById("dropOffFuelCost").value = `Drop-Off Cost ( ${dropOffKm.split("|")[1]} ) ₱${dropOffUpCost}`;
        
        document.getElementById("agreementCheckbox").checked = false;
    }

    function verifyDate(){
        document.getElementById("rentDuration").value = "-";
        document.getElementById("payMonthly").disabled = true;
        document.getElementById("payWeekly").disabled = true;
        rentDuration = 0;

        if(startDate.value != ""){
            let dateOffset = new Date();

            let startDayOnly = document.getElementById("startDateTime").value.split("-");
            startDayOnly = startDayOnly[2].split("T");
            dateOffset.setDate(parseInt(startDayOnly[0]));
            dateOffset = new Date(dateOffset.getTime() + 86400000);

            startDateTime = startDate.value.replace("T", " ");
            
            let minEndDate = `${dateOffset.getFullYear()}-${dateOffset.getMonth().toString().length != 1 ? (dateOffset.getMonth()+1) : "0" +(dateOffset.getMonth()+1)}-${dateOffset.getDate().toString().length != 1 ? dateOffset.getDate() : "0" +dateOffset.getDate()}T${dateOffset.getHours().toString().length != 1 ? dateOffset.getHours() : "0" +dateOffset.getHours()}:${dateOffset.getMinutes().toString().length != 1 ? dateOffset.getMinutes() : "0" +dateOffset.getMinutes()}`;
                
            endDate.min = minEndDate;
            endDate.disabled = false;
            if(endDate.value != ""){
                const tempStartDate = Date.parse(startDate.value);
                const tempEndDate = Date.parse(endDate.value);

                endDateTime = endDate.value.replace("T", " ");
                const hours = Math.floor((tempEndDate - tempStartDate) / 1000 / 60 / 60); 
                if(hours < 12){
                    if(hours <= 0){
                        endDate.value = "";
                        document.querySelector(".endDateInvalid").innerHTML = "";
                    }else{
                        document.querySelector(".endDateInvalid").innerHTML = "Rent Duration is Less Than 12 Hours!";
                    }
                }else{
                    document.querySelector(".endDateInvalid").innerHTML = "";

                    if(hours >= 24){
                        const day = hours / 24;
                        rentDuration = day.toFixed(2);

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
                }else{
                    document.getElementById("payDaily").disabled = false;
                    document.getElementById("payDaily").selected = true;
                }
            }else{
                endDateTime = "";
                document.getElementById("invalidPay").selected = true;
                document.getElementById("payDaily").disabled = true;
            }
        }else{
            endDate.disabled = true;
            endDate.value = "";
            startDateTime = "";
            endDateTime = "";
            document.getElementById("invalidPay").selected = true;
            document.getElementById("payDaily").disabled = true;
        }
        initialRentPrice = (rentDuration * document.querySelector(".rentCarPrice").innerHTML).toFixed(2);
        calcPrice();
    }

    function updateLocationCost(){
        const pickUpKm = document.getElementById("pickUpLocation").value;
        pickUpCost = pickUpKm.split("|")[1].substr(0, pickUpKm.split("|")[1].length-2) * 5;

        const dropOffKm = document.getElementById("dropOffLocation").value;
        dropOffUpCost = dropOffKm.split("|")[1].substr(0, dropOffKm.split("|")[1].length-2) * 5;

        document.getElementById("pickUpFuelCost").value = `Pick-Up Cost ( ${pickUpKm.split("|")[1]} ) ₱${pickUpCost}`;
        document.getElementById("dropOffFuelCost").value = `Drop-Off Cost ( ${dropOffKm.split("|")[1]} ) ₱${dropOffUpCost}`;
        calcPrice();
    }

    function verifyForm(){
        if(startDateTime == "" || endDateTime == "" || paymentMethod.value == ""){
        }else{
            console.log(pickUpLocation.value);
            console.log(dropOffLocation.value);
            console.log(startDateTime);
            console.log(endDateTime);
            console.log(paymentMethod.value);
            console.log(amountPaid.innerHTML);
            console.log(voucher.value)
        }
    }

    function calcPrice(){
        if(initialRentPrice != 0){
            document.getElementById("amountPaid").innerHTML = (parseFloat(initialRentPrice) + (pickUpCost + dropOffUpCost)).toFixed(2);
        }else{
            document.getElementById("amountPaid").innerHTML = "-";
        }
    }

    document.getElementById("pickUpLocation").onchange = (e) => {updateLocationCost()}
    document.getElementById("dropOffLocation").onchange = (e) => {updateLocationCost()}
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