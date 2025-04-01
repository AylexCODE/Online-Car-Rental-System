<style type="text/css">
    @font-face{
        font-family: space-grotesk-regular;
        url: ("../fonts/SpaceGrotesk-Regular.otf");
        src: url("../fonts/SpaceGrotesk-Regular.otf");
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
    }

    nav{
        position: fixed;
        top: 0px;
        height: 40px;
        width: 100%;
        background-color: #031A0970;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(2px);
        z-index: 99;
    }

    nav > span {
        display: flex;
        flex-direction: row;
        text-wrap: nowrap;
        margin-inline: 2%;
        gap: 5%;
        width: 20%;
    }

    nav > span:nth-child(1) {
        gap: 20%;
    }

    nav > span:nth-child(1) > button {
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    nav > span:nth-child(1) > .active {
        transform: translateY(-2px);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .navIndicator {
        position: fixed;
        top: 30px;
        height: 2px;
        background-color: #E2F87B;
        z-index: 100;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .authGuest {
        gap: 3%;
        justify-content: right;
    }

    .authGuest > a, .logout > a {
        border: 1px solid #FDFFF6;
        background-color: #FDFFF620;
        border-radius: 8px;
        padding-block: 3px;
        padding-inline: 13px;
        font-weight: 500;
    }
    
    .authGuest > a:nth-child(1) {
        background-color: #FDFFF6;
        color: #091A09;
        font-weight: 700;
    }

    nav > span > h3, nav > span > p, nav > span > button, nav > span > a, nav > span > a:visited {
        color: #FDFFF6;
        text-decoration: none;
        background-color: transparent;
        border: none;
    }

    .logout {
        display: block;
        text-align: right;
    }

    .homePage.active, .aboutPage.active, .contactPage.active {
        display: block;
    }

    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .homePage, .aboutPage, .contactPage {
        display: none;
    }

    .guestBG {
        width: 100%;
        height: 65%;
        border-radius: 0px 0px 15px 15px;
        overflow: hidden;
        position: sticky;
        top: -40%;
        z-index: 10;
    }

    .guestBG > span {
        width: 100dvw;
        height: 100dvh;
        transform: translateY(20%);
        display: block;
        background-image: url("./images/backgrounds/homeBG.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top;
        animation: guestBGScroll linear;
        animation-timeline: scroll(root);
        animation-range-start: contain;
        animation-range-end: 250px;
    }

    .guestBG > span > p {
        color: #FDFFF6;
        text-transform: uppercase;
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        height: 65%;
        transform: translateY(50%);
        text-shadow: 2px 2px #091A09;
    }

    @keyframes guestBGScroll {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(20%);
        }
    }

    .rentStatusWrapper {
        width: 100%;
        height: 320px;
        background-color: #316C40;
        border-radius: 0px 0px;
        background-color: #FDFFF6;
    }

    .rentStatusWrapper > span {
        width: 100dvw;
        height: 100dvh;
        transform: translateY(20%);
        display: block;
        animation: guestBGScroll linear;
        animation-timeline: scroll(root);
        animation-range-start: contain;
        animation-range-end: 250px;
    }

    .rentStatusWrapper > span > div {
        color: #FDFFF6;
        display: grid;
        place-items: center;
        transform: translateY(150px);
    }
    
    .userRentStatus > span {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        background-color: #316C4090;
        border: 1px solid #E2F87B;
        border-radius: 5px;
        gap: 5px;
        width: 85%;
        padding-inline: 20px;
        padding-block: 10px;
    }

    .pickupLocation, .pickupTime, .pickupDate, .returnDate, .returnTime {
        text-shadow: 2px 2px #031A09;
        overflow-x: scroll;
    }

    .pickupLocation > p:first-child, .pickupTime > p:first-child, .pickupDate > p:first-child, .returnDate > p:first-child, .returnTime > p:first-child {
        font-size: 14px;
        position: sticky;
        opacity: .8;
        top: 0px;
        left: 0px;
    }

    .carsWrapper {
        height: 75%;
        width: 100%;
        margin-top: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #FDFFF6;
    }

    .carFilter {
        width: 85%;
        margin-top: 5px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }

    .carFilter > span > p {
        font-size: 12px;
        opacity: .8;
        margin-bottom: .5px;
    }

    .carFilter > span > input, .carFilter > span > button, .carFilter > span > select {
        border: 1px solid #E2F87B;
        background-color: #316C40;
        color: #FDFFF6;
        text-align: center;
        width: 150px;
        padding-left: 15px;
        padding-block: 5px;
        border-radius: 5px;
        margin-block: 2.5px;
    }

    .carFilter > span > button, .carFilter > span > select {
        border: none;
        padding-left: unset;
    }

    .carFilter > span > select {
        width: 130px;
    }

    .carFilter > span > input::placeholder {
        color: #FDFFF6;
    }

    .carsDisplay {
        width: 85%;
        margin-top: 5px;
        height: 100%;
        overflow: hidden;
    }
    
    .carsDisplay > span {
        width: 100%;
        height: 100%;
        margin-top: 2.5px;
        padding-bottom: 25px;
        overflow-y: scroll;
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .car {
        display: block;
        height: 300px;
        width: 280px;
        border: 1px solid white;
        border-radius: 5px;
    }

    /* Admin */
    .adminNav {
        flex-direction: column;
        width: 20%;
        min-width: 200px;
        height: 100%;
        justify-content: space-around;
    }

    .adminNav > span {
        width: 50%;
        text-transform: uppercase;
    }

    .adminNav > span > button {
        text-transform: uppercase;
    }

    .adminNav > span:nth-child(2){
        flex-direction: column;
        gap: 10px;
        align-items: start;
        margin-bottom: 20%;
        z-index: 99;
    }

    .adminNav > span:nth-child(2) > button.active {
        transform: translateX(5px);
    }

    .adminNav > span:nth-child(2) > button {
        display: flex;
        align-items: center;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .adminNav > span:nth-child(2) > button > img,  .adminNav > span:nth-child(3) > a > img {
        margin-right: 5px;
    }

    .adminNav > span:nth-child(3) > a {
        display: flex;
        flex-direction: row;
        align-items: center;
        background-color: #E2F87B;
        color: #000000;
        font-weight: 700;
        padding-inline: 10px;
        padding-block: 2.5px;
        border-radius: 5px;
    }

    .adminNav > span > .moreVehicleSettings {
        height: 0px;
        visibility: hidden;
        overflow: hidden;
        margin-left: -10px;
        opacity: 0;
    }
    
    .adminNav > span > .moreVehicleSettings.open {
        visibility: visible;
        display: flex;
        flex-direction: column;
        gap: 5px;
        height: fit-content;
        margin-left: 0px;
        opacity: 1;
        transition: all 1s;
    }

    .adminNav > span > .moreVehicleSettings > button {
        background-color: transparent;
        border: none;
        outline: none;
        color: #FDFFF6;
        font-size: 14px;
        margin-left: 10px;
    }

    .adminNavIndicator {
        position: fixed;
        border: 1px solid #E2F87B;
        border-radius: 5px;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .adminBody {
        display: flex;
        flex-direction: row;
        height: 100%;
        width: 100%;
    }

    .adminDisplayOffset {
        display: block;
        width: 20%;
        min-width: 200px;
        height: 100%;
    }

    .adminDisplay {
        height: 100%;
        width: 80%;
    }
</style>