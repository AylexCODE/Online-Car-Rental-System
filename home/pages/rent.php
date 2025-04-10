<?php
    echo "<div class='rentCar'>
        <h2>Rental Form</h2>
        <form>
            <span>
                <span>
                    <span>
                        <p class='rentInfoHeader'>Location & Date</p>
                        <span>
                            <label for='startDateTime'>Start/Pick-Up Date & Time</label>
                            <input type='datetime-local' id='startDateTime' name='startDateTime'>
                        </span>
                        <span>
                            <label for='endDateTime'>End/Drop-Off Date & Time</label>
                            <input type='datetime-local' id='endDate' name='endDate'>
                        </span>
                        <span>
                            <label for='pickupLocation'>Pickup Location</label>
                            <select id='pickupLocation' name='pickupLocation'>
                                <option>Balilihan</option>
                                <option>Balilihan</option>
                            </select>
                        </span>
                        <span>
                            <label for='dropOffLocation'>Drop off Location</label>
                            <select id='dropOffLocation' name='dropOffLocation' style='margin-bottom: 5px;'>
                                <option>Balilihan</option>
                                <option>Balilihan</option>
                            </select>
                        </span>
                    </span>
                    <span class='rentCarInfo'>
                        <p class='rentInfoHeader'>Car Information</p>
                        <img height='180px' width='277px'>
                        <p style='font-size: 20px;'>Ford Ranger</p>
                        <span><span>₱&nbsp;</span><p>5000/Monthly</p></span>
                        <span><img src='./images/icons/fuelType-icon.svg' height='14px' width='14px'>&nbsp;<p>Gasoline</p></span>
                        <span><img src='./images/icons/transmission-icon.svg' height='14px' width='14px'>&nbsp;<p>Manual</p></span>
                    </span>
                </span>
                <span>
                    <span>
                        <iframe width='100%' height='200' style='border: 0' loading='lazy' allowfullscreen referrerpolict='no-referrer-when-downgrade' id='map'
                            src='https://www.google.com/maps/embed/v1/direction?key=g
                            &origin=PXW6+572, Provincial+Road, Balilihan, Bohol&maptype=satellite&destination=QX4H+H2P, Balilihan, Bohol'>
                        </iframe>
                    </span>
                </span>
            </span>
        </form>
        <button>Submit</button>
    </div>";
?>

<style type="text/css">
    .rentCar {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .rentCar > h2 {
        font-size: 28px;
        margin-block: 20px;
    }

    .rentCar .rentInfoHeader {
        text-align: center;
    }

    .rentCar > form > span:first-child {
        border: 2px solid #E2F87B;
        padding: 20px 30px;
        border-radius: 10px;
        display: block;
    }

    .rentCar > form > span:first-child > span:first-child {
        display: flex;
        flex-direction: row;
        gap: 40px;
    }

    .rentCar > form > span:first-child > span:first-child > span:first-child, .rentCar > form > span:first-child > span:first-child > span:first-child > span {
        display: flex;
        flex-direction: column;
    }

    .rentCar > form > span:first-child > span:first-child > span:first-child {
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

    .rentCarInfo > span {
        color: #FDFFF6;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .rentCarInfo > span > p {
        font-size: 14px;
    }
    /*    
Here’s an example of standard **Online Car Rental Agreement Terms and Conditions**. Please note that this is a general template and should be customized according to your local laws and specific business requirements.

---

**Car Rental Agreement Terms and Conditions**

**1. Introduction**
This Car Rental Agreement ("Agreement") is entered into by and between [Rental Company Name], a company registered in [Country/State], with its principal office located at [Address], ("Company", "we", "us", or "our"), and the customer ("Customer", "you", "your") who is renting a vehicle from us under the terms and conditions set forth below.

**2. Rental Period**
The rental period begins when you pick up the vehicle and ends when you return it to the designated return location. If the vehicle is not returned on time, additional rental charges may apply.

**3. Rental Fees**
By agreeing to rent the vehicle, you agree to pay the rental fee specified at the time of booking, plus any applicable taxes, fees, and charges. The rental fee is based on the duration of the rental and the vehicle selected.

**4. Vehicle Use**
You agree to use the rented vehicle solely for lawful purposes and in accordance with local traffic laws. The vehicle must not be used for:
   - Racing, off-road driving, or other activities not intended for standard road use.
   - Transporting hazardous materials or engaging in any illegal activities.
   - Subletting, lending, or giving possession of the vehicle to any other party.

**5. Age Requirement**
The minimum age for renting a vehicle is [insert minimum age], and drivers must hold a valid driver’s license for a minimum of [insert number] years. Young driver fees may apply for those under the age of [insert age].

**6. Driver’s License**
You must provide a valid driver’s license at the time of rental. An international driving permit (IDP) may be required for non-resident drivers. 

**7. Insurance and Liability**
- You are responsible for ensuring the vehicle is adequately insured during the rental period. 
- The rental fee includes basic insurance coverage, but you may be offered additional insurance options for further coverage.
- In case of an accident, theft, or damage to the vehicle, you are responsible for the deductible or any excess costs unless otherwise indicated.
- You are liable for any damages, losses, or penalties incurred during the rental period.

**8. Fuel Policy**
Vehicles are provided with a full tank of fuel and must be returned with the same level of fuel. Failure to do so will result in a refueling charge at prevailing fuel rates.

**9. Reservation and Payment**
A reservation can be made through our online platform. A valid credit card is required to secure your booking. Payments can be made via credit/debit card, or any other accepted payment method. A deposit may be required at the time of reservation, and the balance will be charged upon vehicle pick-up.

**10. Cancellation Policy**
- Cancellations made at least [X] hours/days before the rental period begins will receive a full refund.
- Cancellations made within [X] hours/days before the rental period begins may be subject to a cancellation fee.
- No refunds will be given for cancellations made after the rental period has commenced.

**11. Late Returns**
Late returns will incur additional fees, which are charged on an hourly/daily basis. If you are unable to return the vehicle on time, you must inform us as soon as possible.

**12. Restrictions**
You may not:
   - Take the vehicle outside of the agreed area or country (without prior written consent).
   - Transport animals in the vehicle (unless prior arrangements are made).
   - Smoke or allow smoking in the vehicle.
   - Drive the vehicle under the influence of alcohol or drugs.

**13. Vehicle Condition**
You are responsible for inspecting the vehicle at the time of pick-up and notifying us of any existing damage or issues. You must return the vehicle in the same condition, minus normal wear and tear.

**14. Force Majeure**
We are not responsible for delays or cancellations caused by circumstances beyond our control, including but not limited to natural disasters, strikes, government actions, or other unforeseen events.

**15. Governing Law**
This agreement is governed by the laws of [Country/State]. Any disputes arising from this agreement will be resolved in the courts of [Location].

**16. Indemnity**
You agree to indemnify and hold [Company Name] harmless from any claims, damages, or liabilities arising from your use of the rental vehicle, including but not limited to accidents, violations, or breaches of this Agreement.

**17. Privacy**
We respect your privacy. By booking a rental, you consent to the collection and processing of your personal data as outlined in our privacy policy, which can be found on our website.

**18. Miscellaneous**
- This agreement may be modified only by a written document signed by both parties.
- If any provision of this agreement is found to be invalid or unenforceable, the remaining provisions will continue in full force and effect.

---

**By booking or renting a vehicle from [Company Name], you confirm that you have read, understood, and agree to these terms and conditions.**

---

Feel free to adapt this example to meet the specifics of your business or jurisdiction, and make sure to consult with a legal professional to ensure that your terms and conditions comply with local regulations.
*/
</style>