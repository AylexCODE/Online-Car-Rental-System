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
        height: 100dvh;
        width: 100dvw;
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
        background-color: #031A0970;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(2px);
        z-index: 99;
    }

    .guestBG {
        width: 100%;
        height: 100px;
        background-image: url("./images/backgrounds/homeBG.jpg");
    }
</style>