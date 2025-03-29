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

    .authGuest > a {
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

    .guestBG {
        width: 100%;
        height: 65%;
        border-radius: 15px;
        overflow: hidden;
        position: sticky;
        top: -40%;
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
    }

    .carFilter > span > p {
        font-size: 12px;
        opacity: .8;
        margin-bottom: 3px;
    }

    .carFilter > span > input, .carFilter > span > button, .carFilter > span > select {
        border: 2px solid #091A0970;
        background-color: #316C40;
        color: #FDFFF6;
        text-align: center;
        width: 150px;
        padding-left: 15px;
        padding-block: 5px;
        border-radius: 5px;
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
</style>