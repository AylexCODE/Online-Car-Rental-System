<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @font-face{
            font-family: space-grotesk-regular;
            url: ("../../fonts/SpaceGrotesk-Regular.otf");
            src: url("../../fonts/SpaceGrotesk-Regular.otf");
        }
        @font-face{
            font-family: space-grotesk-semibold;
            url: ("../../fonts/SpaceGrotesk-SemiBold.otf");
            src: url("../../fonts/SpaceGrotesk-SemiBold.otf");
        }
        * {
            margin: 0;
            padding: 0;
            font-family: space-grotesk-regular;
            font-size: 16px;
            box-sizing: border-box;
            user-select: none;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body{
            height: 100dvh;
            width: 100dvw;
            background-color: #294E28;
            overflow-y: scroll;
            scroll-behavior: smooth;
            display: grid;
            place-items: center;
            color: #FDFFF6;
        }

        h3{
            font-size: 24px;
        }

        div{
            width: 42.5%;
            height: 60%;
            overflow-y: scroll;
            background-color: #316C40;
            display: flex;
            flex-direction: column;

            &::-webkit-scrollbar {
                display: block;
                width: 10px;
                background-color: #38814a;
            }

            &::-webkit-scrollbar-thumb{
                background:rgb(103, 221, 133);
            }

            padding: 15px 20px;
        }

        span:not(:has(button)){
            width: 95%;
            height: 1px;
            background-color: #FDFFF6;
            margin-inline: auto;
            display: block;
            opacity: 0.7;
            margin-block: 15px 5px;
        }

        strong {
            font-family: space-grotesk-semibold;
            display: block;
            margin-block: 15px 5px;
        }

        .indent {
            display: block;
            width: 95%;
            align-self: flex-end;
        }

        span:has(button){
            position: sticky;
            margin-top: 15px;
            bottom: -15px;
            width: 100%;
            background-color: #316C40;
            display: flex;
            place-items: center;
        }

        .acceptButton {
            outline: none;
            padding-block: 2.5px;
            width: 100%;
            color: #294E28;
        }
    </style>
    <title>Terms And Conditions</title>
</head>
<body>
    <div id='agreement'>
        <h3>Car Rental Agreement Terms and Conditions</h3>
        <span></span>
        <strong>Rental Period</strong>
        <p>The rental period begins when you pick up the vehicle and ends when you return it to the designated return location. If the vehicle is not returned on time, additional rental charges may apply.</p>
        
        <strong>Rental Fees</strong>
        <p>By agreeing to rent the vehicle, you agree to pay the rental fee specified at the time of booking, plus any applicable taxes, fees, and charges. The rental fee is based on the duration of the rental and the vehicle selected.</p>

        <strong>Vehicle Use</strong>
        <p>You agree to use the rented vehicle solely for lawful purposes and in accordance with local traffic laws. The vehicle must not be used for:</p>
        <section class='indent'>
            <p>- Racing, off-road driving, or other activities not intended for standard road use.</p>
            <p>- Transporting hazardous materials or engaging in any illegal activities.</p>
            <p>- Subletting, lending, or giving possession of the vehicle to any other party.</p>
        </section>

        <strong>Insurance and Liability</strong>
        <section class='indent'>
            <p>- You are responsible for ensuring the vehicle is adequately insured during the rental period.</p>
            <p>- The rental fee includes basic insurance coverage, but you may be offered additional insurance options for further coverage.</p>
            <p>- In case of an accident, theft, or damage to the vehicle, you are responsible for the deductible or any excess costs unless otherwise indicated.</p>
            <p>- You are liable for any damages, losses, or penalties incurred during the rental period.</p>
        </section>

        <strong>Fuel Policy</strong>
        <p>Vehicles are provided with a full tank of fuel and must be returned with the same level of fuel. Failure to do so will result in a refueling charge at prevailing fuel rates.</p>

        <strong>Cancellation Policy</strong>
        <section class='indent'>
            <p>- Cancellations made at least 24 hours before the rental period begins will receive a full refund.</p>
            <p>- Cancellations made within 12 hours before the rental period begins may be subject to a cancellation fee.</p>
            <p>- No refunds will be given for cancellations made after the rental period has commenced.</p>
        </section>

        <strong>Late Returns</strong>
        <p>Late returns will incur additional fees, which are charged on an hourly/daily basis. If you are unable to return the vehicle on time, you must inform us as soon as possible.</p>

        <strong>Restrictions</strong>
        <p>You may not:</p>
        <section class='indent'>
            <p>- Smoke or allow smoking in the vehicle.</p>
            <p>- Drive the vehicle under the influence of alcohol or drugs.</p>
        </section>

        <strong>Vehicle Condition</strong>
        <p>You are responsible for inspecting the vehicle at the time of pick-up and notifying us of any existing damage or issues. You must return the vehicle in the same condition, minus normal wear and tear.</p>

        <strong>Force Majeure</strong>
        <p>We are not responsible for delays or cancellations caused by circumstances beyond our control, including but not limited to natural disasters, strikes, government actions, or other unforeseen events.</p>

        <strong>Indemnity</strong>
        <p>You agree to indemnify and hold [Company Name] harmless from any claims, damages, or liabilities arising from your use of the rental vehicle, including but not limited to accidents, violations, or breaches of this Agreement.</p>

        <strong>Privacy</strong>
        <p>We respect your privacy. By booking a rental, you consent to the collection and processing of your personal data as outlined in our privacy policy, which can be found on our website.</p>

        <br>
        <p>By booking or renting a vehicle from <u>Quick Ride</u> you confirm that you have read, understood, and agree to these terms and conditions.</p>
        <span>
            <button class='acceptButton' disabled="true" onclick="window.close()">Agree & Continue</button>
        </span>
    </div>
</body>
<script type="text/javascript">
    const agreement = document.getElementById("agreement");

    agreement.addEventListener('scroll', () => {
        if(agreement.scrollTop+100 >= agreement.scrollHeight - agreement.clientHeight){
            document.querySelector(".acceptButton").disabled = false;
        }
    });
</script>
</html>