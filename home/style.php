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

    body{
        height: 100%;
        width: 100%;
        background-color: #294E28;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    nav{
        position: fixed;
        top: 0px;
        height: 40px;
        width: 100%;
        background-color: #316C40;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        color: #FDFFF6;
        z-index: 99;
    }

    h3 {
        text-wrap: nowrap;
    }

    button {
        background-color: transparent;
        border: none;
        outline: none;
        color: #FDFFF6;
    }

    nav > span:nth-child(1) {
        height: 40px;
        background-color: #316C40;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        color: #FDFFF6;
        gap: 15%;
        margin-left: 20px;
    }

    nav > span:nth-child(2) > a, nav > span:nth-child(2) > a:visited{
        color: #000;
        border-radius: 5px;
        background-color: #E2F87B;
        text-decoration: none;
        padding-inline: 10px;
        padding-block: 5px;
        font-weight: 600;
        text-wrap: nowrap;
    }

    nav > span:nth-child(2){
        height: 40px;
        background-color: #316C40;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        gap: 10px;
        margin-right: 20px;
        text-wrap: nowrap;
    }

    .navOffset {
        width: 100%;
        height: 50px;
    }

    .rentStatusWrapper {
        height: 175px;
        width: 100%;
        background-color: #031A09;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .userRentStatus {
        position: relative;
        display: flex;
        flex-direction: row;
        gap: 5px;
    }

    .userRentStatus > span  {
        background-color: #316C40;
        border-radius: 5px;
        padding-block: 10px;
        padding-inline: 60px;
        color: #FDFFF6;
    }

    .userRentStatus > span > p:nth-child(1) {
        font-size: 12px;
        opacity: .8;
        text-wrap: nowrap;
    }

    .userRentStatus > span > p:nth-child(2) {
        text-wrap: nowrap;
    }

    .carsDisplay {
        width: 82.5%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .carsDisplay > h3 {
        align-self: flex-start;
        margin-top: 20px;
    }

    .carsFilter {
        position: relative;
        top: 20px;
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 10px;
        justify-content: space-between;
    }

    .carsFilter > span:nth-child(1) {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
    }

    .carsFilter > span:nth-child(1) > button {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .carsFilter > span:nth-child(1) > select, .carsFilter > span:nth-child(1) > button {
        outline: none;
        border: 3px solid #031A09;
        border-radius: 5px;
        padding-inline: 15px;
        padding-block: 2px;
        background-color: #316C40;
        color: #FDFFF6;
    }

    .carsFilter > span:nth-child(2) > select {
        outline: none;
        border: 3px solid #316C40;
        background-color: #316C40;
        border-radius: 5px;
        padding-inline: 15px;
        padding-block: 2px;
        color: #FDFFF6;
    }

    .carsFilter > select {
        outline: none;
        border: 1px solid #FDFFF6;
        border-radius: 5px;
        padding-inline: 15px;
        padding-block: 2px;
    }
</style>