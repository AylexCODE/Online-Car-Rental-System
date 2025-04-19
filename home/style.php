<style type="text/css">
    @font-face{
        font-family: space-grotesk-regular;
        url: ("../fonts/SpaceGrotesk-Regular.otf");
        src: url("../fonts/SpaceGrotesk-Regular.otf");
    }
    @font-face{
        font-family: space-grotesk-semibold;
        url: ("../fonts/SpaceGrotesk-SemiBold.otf");
        src: url("../fonts/SpaceGrotesk-SemiBold.otf");
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

    input:-webkit-autofill {
        -webkit-background-clip: text;
        -webkit-text-fill-color: #ffffff;
        box-shadow: inset 0 0 20px 20px #FDFFF615;
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

    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
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

    .pickupLocation, .startTime, .startDate, .returnDate, .returnTime {
        text-shadow: 2px 2px #031A09;
        overflow-x: scroll;
    }

    .pickupLocation > p:first-child, .startTime > p:first-child, .startDate > p:first-child, .returnDate > p:first-child, .returnTime > p:first-child {
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
        padding-top: 7.5px;
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
        /* height: 300px; */
        height: fit-content;
        width: 280px;
        border: 1px solid white;
        border-radius: 5px;
        overflow: scroll;
        transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .car:hover {
        scale: 1.03;
        transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .car > img {
        height: 180px;
        width: 277.5px;
    }

    .car > p:nth-child(2) {
        width: 95%;
        margin-inline: auto;
        text-wrap: nowrap;
        overflow-x: scroll;
        font-size: 18px;
    }

    .car > p:nth-child(3) {
        width: 95%;
        margin-left: 2.5%;
        text-wrap: nowrap;
        overflow-x: scroll;
        font-size: 14px;
        opacity: 0.8;
        margin-bottom: 5px;
    }

    .car > span:last-child {
        width: 265px;
        display: grid;
        place-items: center;
    }

    .car > span {
        width: 95%;
        margin-left: 2.5%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .car > span > p {
        font-size: 14px;
        margin-left: 2.5%;
        width: 150px;
        margin-block: 1px;
    }
    
    #availabilityStatus {
        text-wrap: nowrap;
        overflow-x: scroll;
        width: 100%;
    }

    .car > span > button {
        margin: 5px 0px;
        padding: 3px 50px;
        background-color: #E2F87B;
        border: none;
        border-radius: 5px;
        color: #031A09;
    }

    .car > span > .notAvailable {
        background-color: #F77;
        color: #FDFFF6;
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

    .adminNav > span > .moreVehicleSettings > a {
        background-color: transparent;
        text-transform: capitalize;
        color: #FDFFF6;
        font-size: 14px;
        margin-left: 10px;
        text-decoration: none;
    }
    
     .adminNav > span > .moreVehicleSettings > a:visited, .adminNav > span > .moreVehicleSettings > a:focus, .adminNav > span > .moreVehicleSettings > a:hover {
        background-color: transparent;
        color: #FDFFF6;
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
        /* padding: 15px 25px; */
    }

    .carManagement, .userManagement, .rentals, .voucherManagement {
        display: none;
        color: #FDFFF6;
    }
    
    .carManagement.active, .userManagement.active, .rentals.active, .voucherManagement.active{
        display: flex;
        gap: 10px;
        flex-direction: column;
    }

    .carManagement > h4, .userManagement > h4, .rentals > h4, .voucherManagement > h4 {
        font-size: 24px;
        width: 100%;
        padding-bottom: 10px;
        margin-bottom: 5px;
        border-bottom: 1px solid #FDFFF690;
        padding: 15px 25px;
    }

    #carManagement > span:nth-child(2) > span > span:nth-child(2) > .scrollCars {
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

    #carManagement > span:nth-child(2) > span > span:nth-child(2) > .scrollCars > .car {
        /* height: 235px; */
        width: 180px;
    }

    #carManagement > span:nth-child(2) > span > span:nth-child(2) > .scrollCars > .car > img {
        height: 116px;
        width: 178px;
    }

    #carManagement > span:nth-child(2) > span > span:nth-child(2) > .scrollCars > .car > span:last-child {
        width: 170px;
    }

    /* #addCars {
        border: 1px solid #E2F87B;
        border-radius: 5px;
        position: absolute;
        bottom: 50%;
        left: 58%;
        transform: translate(-50%, 2%);
    } */

    #addCars, #addBrands, #addLocations {
        border: 1px solid #E2F87B;
        border-radius: 5px;
        display: none;
        width: fit-content;
        height: fit-content;
        pointer-events: all;
        overflow: hidden;
        /* position: absolute;
        bottom: 50%;
        left: 58%;
        transform: translate(-50%, 40%); */
        /* top: 50%;
        left: 58%;
        transform: translate(-50%, -50%); */
    }

    /* #addCars > button {
        background-color: transparent;
        border: none;
        outline: none;
        color: #FDFFF6;
        position: absolute;
        right: 12.5px;
        top: 10px;
        font-size: 24px;
        color: #E2F87B;
        background-color: red;
    } */
    
    #addCars > form > input, #addCars > form > span > span > input, #addCars > form > span > span > select, .addCarsForm > select, #addBrands > form > input,  #addLocations > form > input, #editPane > span > input, #editPaneLocation > span > input  {
        background-color: transparent;
        outline: none;
        border: none;
        border-bottom: 1px solid #E2F87B;
        color: #FDFFF6;
        padding-top: 10px;
        padding-inline: 2px;
    }

    .addCarsForm > span:nth-child(1) > span:nth-child(2) {
       width: 100%;
    }

    #addCars > form > span > span > select *, .addCarsForm > input, .addCarsForm > select * {
        background-color: #031A09;
    }

    #addCars > form, #addBrands > form, #addLocations > form { 
        display: flex;
        flex-direction: column;
        background-color: #316C40;
        padding: 35px 30px;
        gap: 5px;
        border: 2px solid #E2F87B;
        border-radius: 5px;
        color: #FDFFF6;
    }

    .addCarsForm > span > span:nth-child(2) > select, .addCarsForm > span > span > input, .addCarsForm > input, .addCarsForm > select, #addBrands > form > input, #addLocations > form > input, .availAndPrice > span > select, #editPane > span > input, #editPaneLocation > span > input { 
        height: 35px;
    }

    #addCars > form > input:not([type="file"]), #addCars > form > span > span > input, #addBrands > form > input, #addLocations > form > input {
        padding-inline: 7px;
    }

    .addCarsForm > span { 
        display: flex;
        flex-direction: row;
        column-gap: 10px;
    }

    .addCarsForm > span > span { 
        display: flex;
        flex-direction: column;
    }

    .addCarsForm > span > span > label {
        transform: translateY(-46px);
        font-size: 14px;
        opacity: 0.8;
    }

    #editPane > span > label, #editPaneLocation > span > label {
        transform: translateY(-46px);
        font-size: 14px;
        opacity: 0.8;
        text-align: left;
        width: 100%;
    }

    .addCarsForm > label, .addBrandsForm > label, .addLocationsForm > label { 
        transform: translateY(-48px);
        font-size: 14px;
        opacity: 0.8;
    }

    .addCarsForm > input, .addLocationsForm > input, #editPane > span > input, #editPaneLocation > span > input {
        padding-left: 10px;
        width: 100%;
    }

    .addCarsForm > .submitBtn, .addBrandsForm > .submitBtn, .addLocationsForm > .submitBtn, .confirmDelete, .submitEditPane, .confirmEdit, .submitEditPaneLocation {
        background-color: #E2F87B;
        border: none;
        outline: none;
        padding: 5px 15px;
        border-radius: 5px;
        color: #031A09;
        text-align: center;
    }

    .addCarHeader {
        border-bottom: 2px solid #E2F87B;
        opacity: 0.8;
        text-align: center;
        color: #E2F87B;
        position: relative;
        bottom: 20px;
        padding-bottom: 2px;
        text-transform: uppercase;
    }

    .addCarsForm > span:nth-child(2) > span:nth-child(2) {
        width: 100%;
    }
    
    #carImgInput {
        visibility: hidden;
    }
    
    .forCarImg > input {
        position: absolute;
    }

    .forCarImg > label {
        border: 2px solid #E2F87B;
        border-radius: 5px;
        margin-inline: auto;
        padding: 5px 15px;
        margin-bottom: 5px;
    }

    .carImg {
        display: block;
        height: 150px;
        width: 230px;
        margin-inline: auto;
    }

    .addBrandsList, .addLocationsList {
        border: 1px solid #E2F87B;
        padding: 10px 15px;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
    }

    .addBrandsList > p:first-child, .addLocationsList > p:first-child {
        border-bottom: 1px solid #E2F87B90;
        text-align: center;
        width: 100%;
        padding-bottom: 5px;
    }

    .addBrandsList > span, .addLocationsList > span {
        height: 137.5px;
        overflow-y: scroll;
        border-bottom: 1px solid #E2F87B90;
    }

    .addBrandsList > span > p, .addLocationsList > span > p {
        padding: 5px;
        background-color: #316C40;
        margin: 0px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .addBrandsList > span > p > img, .addLocationsList > span > p > span > img {
        margin-left: 5px;
    }

    .addBrandsList > span > p > span > img, .addLocationsList > span > p > span > img {
        margin-left: 5px; 
    }
    
    .addBrandsList > span > p > span, .addLocationsList > span > p > span {
        display: flex;
        flex-direction: row;
    }

    .addBrandsList > span > p:nth-child(odd), .addLocationsList > span > p:nth-child(odd) {
        background-color: #38814a;
    }

    .addBrandErrorMsg, .addLocationErrorMsg, .addCarErrorMsg {
        position: relative;
        top: 5px;
        height: 0px;
        text-align: center;
        font-size: 14px;
        color: #F77;
        opacity: 1;
        text-wrap: nowrap;
    }

    .addCarErrorMsg > p {
        font-size: 14px;
    }

    .addBrandErrorMsg > p, .addLocationErrorMsg > p, .addCarErrorMsg > p {
        opacity: 0;
        text-wrap: nowrap;
    }

    .addBrandErrorMsg > p, .addLocationErrorMsg > p, .addCarErrorMsg > p {
        animation: fadeIn 5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    @keyframes fadeIn {
        0%{
            opacity: 1;
            top: 0px;
        }
        70%{
            opacity: 1;
            top: 0px;
        }
        100%{
            opacity: 0;
            top: 0px;
        }
    }

    .exitButton, .exitConfirmation, .exitEditPane, .exitEditPaneLocation {
        position: relative;
        left: 94%;
        height: 0px;
        font-size: 24px;
        color: #E2F87B;
        border: none;
        outline: none;
        background-color: transparent;
    }

    #deleteConfirmation, #editPane, #editPaneLocation {
        border: 2px solid #E2F87B;
        pointer-events: all;
        border-radius: 5px;
        /* position: absolute;
        top: 50%;
        left: 58%;
        transform: translate(-50%, -50%); */
        background-color: #316C40;
        display: none;
    }
    
    #deleteConfirmation > span, #editPane > span, #editPaneLocation > span {
        display: flex;
        padding: 40px 30px;
        color: #FDFFF6;
        flex-direction: column;
        align-items: center;
    }

    #deleteConfirmation > span > p:first-child, #editPane > span > p:first-child, #editPaneLocation > span > p:first-child{
        border-bottom: 2px solid #FDFFF6;
        padding-bottom: 3px;
        margin-bottom: 5px;
        width: 100%;
        text-align: center;
    }

    #editLocationName, #editMsg {
        margin-bottom: 20px;
    }

    #deleteConfirmation > span > p:nth-child(2) {
        padding-bottom: 3px;
        margin-bottom: 10px;
    }

    .msg, .notif {
        position: absolute;
        top: -100px;
        /* left: 50%; */
        z-index: 999;
        width: 80vw;
        right: 0px;
        display: grid;
        place-items: center;
    }

    .notif {
        position: fixed;
        width: 100vw;
    }
    
    .msg > .error, .msg > .success, .notif > .success, .notif > .error {
        position: relative;
        color: rgb(255, 100, 100);
        /* right: 2.5%; */
        top: 50px;
        text-wrap: nowrap;
        border: 2px solid #F77;
        padding: 5px 10px;
        background-color: #38814a;
        font-weight: bold;
        border-radius: 5px;
        animation: msgSlideDown 5s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .msg > .success, .notif > .success  {
        color: #E2F87B;
        border: 2px solid #E2F87B;
    }

    @keyframes msgSlideDown {
        0%{
            opacity: 0;
        }
        30%{
            opacity: 1;
            top: 150px;
        }
        70%{
            opacity: 1;
            top: 150px;
        }
        100%{
            opacity: 0;
            top: 0px;
        }
    }
</style>