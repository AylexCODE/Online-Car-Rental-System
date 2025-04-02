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

    .adminNavIndicator {
        position: fixed;
        border: 1px solid #E2F87B;
        border-radius: 5px;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }
    
    .adminNav > span > .moreVehicleSettings {
        visibility: hidden;
        height: 0px;
        margin-left: -10px;
        overflow: hidden;
        gap: 5px;
        opacity: 0;
    }
    
    .adminNav > span > .moreVehicleSettings.open {
        visibility: visible;
        display: flex;
        flex-direction: column;
        height: fit-content;
        align-items: flex-start;
        margin-left: 0px;
        opacity: 1;
        transition: all 1s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .adminNav > span > .moreVehicleSettings > button {
        background-color: transparent;
        border: none;
        text-transform: capitalize;
        color: #FDFFF6;
        font-size: 14px;
        margin-left: 10px;
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
        padding: 15px 25px;
    }

    .vehicleStatistics, .vehicleManagement {
        display: none;
        color: #FDFFF6;
    }
    .vehicleStatistics.active, .vehicleManagement.active {
        display: flex;
        gap: 10px;
        flex-direction: column;
    }

    .vehicleStatistics > h4, .vehicleManagement > h4 {
        font-size: 24px;
        width: 100%;
        padding-bottom: 10px;
        margin-bottom: 5px;
        border-bottom: 1px solid #FDFFF690;
    }

    .vehicleStatistics > span:nth-child(2){
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .vehicleStatistics > span > span {
        width: fit-content;
        padding: 15px 20px;
        background-color: #316C40;
        border-radius: 5px;
    }

    .vehicleStatistics > span > span > p:nth-child(1){
        font-size: 16px;
        border-bottom: 1px solid #FDFFF690;
        padding-bottom: 5px;
        opacity: 0.8;
        text-align: center;
    }

    .vehicleStatistics > span > span > p:nth-child(2){
        font-size: 20px;
        padding-top: 5px;
        text-align: center;
    }

    .vehicleStatistics > span > span > button {
        background-color: transparent;
        outline: none;
        border: none;
        opacity: 0.6;
        font-size: 14px;
        color: #FDFFF6;
        margin-top: 5px;
    }

    .vehicleStatistics > span:nth-child(3){
        padding-inline: 20px;
        background-color: #316C40;
        border-radius: 5px;
        height: 68dvh;
        overflow: auto;
    }
    
    .recentVehicleActivity {
        width: 100%;
        color: #FDFFF6;
    }

    .vehicleStatistics > span:nth-child(3) > p {
        padding-top: 25px;
        position: sticky;
        top: 2px;
        background-color: #316C40;
    }

    .recentVehicleActivity th{
        position: sticky;
        top: 46px;
        text-align: left;
        padding-top: 20px;
        padding-bottom: 10px;
        font-weight: normal;
        border-bottom: 1px solid #FDFFF690;
        background-color: #316C40;
    }

    .recentVehicleActivity td{
        padding-block: 10px;
    }

    .vehicleManagement > span:nth-child(2){
        display: flex;
        flex-direction: row;
        gap: 10px;
        width: 100%;
        height: 85vh;
    }
    
    .vehicleManagement > span:nth-child(2) > span:nth-child(1) {
        height: 100%;
        width: 20%;
        background-color: #316C40;
        border-radius: 5px;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 80%;
        gap: 10px;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) > span:nth-child(1) {
        display: flex;
        flex-direction: row;
        justify-content: left;
        align-items: center;
        background-color: #316C40;
        border-radius: 5px;
        height: 18%;
        width: 100%;
        padding-inline: 4%;
        gap: 3%;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) > span:nth-child(1) > button {
        border: none;
        outline: none;
        background-color: #E2F87B;
        color: #031A09;
        padding-inline: 5%;
        padding-block: 15px;
        border-radius: 5px;
        font-weight: bold;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) > span:nth-child(2) {
        display: block;
        background-color: #316C40;
        border-radius: 5px;
        height: 82%;
        width: 100%;
        padding: 10px 20px;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) > span:nth-child(2) > .scrollCars {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: 92%;
        width: 100%;
        overflow-y: scroll;
        margin-top: 5px;
        justify-content: center;
        gap: 10px;
    }

    .vehicleManagement > span:nth-child(2) > span:nth-child(2) > span:nth-child(2) > .scrollCars > .car {
        height: 200px;
        width: 180px;
    }

    #addCars {
        border: 1px solid #E2F87B;
        border-radius: 5px;
        position: absolute;
        top: 50%;
        left: 58%;
        transform: translate(-50%, -50%);
    }
    
    #addCars, #addCars > span > input, #addCars > span > span > input, #addCars > span > span > select {
        background-color: transparent;
        outline: none;
        border: none;
        border-bottom: 1px solid #E2F87B;
        color: #FDFFF6;
    }

    #addCars > span > select * {
        background-color: #031A09;
    }

    #addCars > span { 
        display: flex;
        flex-direction: column;
        background-color: #316C40;
        padding: 15px 25px;
        border: 2px solid #E2F87B;
        border-radius: 5px;
        color: #FDFFF6;
    }
</style>