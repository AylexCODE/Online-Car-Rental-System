<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rent</title>
    </head>
    <body>
        <div class='rentCar'>
            <h2>Rental Form</h2>
            <form method='post'>
                <span>
                    <span>
                        <label for='startDate'>Start Date</label>
                        <input type='date' id='startDate' name='startDate' required>
                    </span>
                    <span>
                        <label for='startTime'>Start Time</label>
                        <input type='time' id='startTime' name='startTime' required>
                    </span>
                </span>
                <span>
                    <span>
                        <label for='endDate'>End Date</label>
                        <input type='date' id='endDate' name='endDate' required>
                    </span>
                    <span>
                        <label for='endTime'>End Time</label>
                        <input type='time' id='endTime' name='endTime' required>
                    </span>
                </span>
                <span>
                    <span>
                        <label for='pickupLocation'>Pickup Location</label>
                        <select id='pickupLocation' name='pickupLocation'>
                            <option>Balilihan</option>
                        </select>
                    </span>
                    <span>
                        <label for='dropOffLocation'>Drop off Location</label>
                        <select id='dropOffLocation' name='dropOffLocation'>
                            <option>Balilihan</option>
                        </select>
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
            </form>
            <button>Submit</button>
        </div>
    </body>
</html>

<style type="text/css">
    @font-face{
        font-family: space-grotesk-regular;
        url: ("../../fonts/SpaceGrotesk-Regular.otf");
        src: url("../../fonts/SpaceGrotesk-Regular.otf");
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
    
    body {
        height: 100vh;
        width: 100vw;
        overflow: scroll;
    }
    
    .rentCar {
        padding-top: 20px;
        background-color: #316C40;
        display: flex;
        width: 100%;
        height: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #FDFFF6;
    }

    .rentCar > h2 {
        color: #FDFFF6;
        padding-bottom: 5px;
        font-size: 24px;
        margin-bottom: 5px;
    }
    
    .rentCar > form {
        border: 2px solid #FDFFF6;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        width: 60%;
        padding: 0px 15px 10px 15px;
    }

    .rentCar > form > span > span > label {
        transform: translateY(10px);
        margin: 0px 5px;
        margin-bottom: 5px;
        font-size: 14px;
        opacity: 0.8;
    }

    .rentCar > form > span > span > input, .rentCar > form > span > span > select {
        padding: 5px 10px;
        height: 30px;
        margin-bottom: 10px;
        border: none;
        border-bottom: 1px solid #FDFFF6;
        /* border-radius: 4px; */
        background-color: transparent;
        color: #FDFFF6;
        outline: none;
    }

    input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert();
    }

    .rentCar > form > span {
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .rentCar > form > span > span {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .rentCar > .terms {
        margin-top: 20px;
        font-size: 14px;
    }
</style>