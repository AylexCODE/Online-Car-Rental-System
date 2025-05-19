<style type="text/css">
    *{
        margin: 0;
        padding: 0;
    }

    .loader {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: #FFF;
        animation: 1.5s pulse infinite ease-in-out;
    }
    
    @keyframes pulse {
        0% {
        box-shadow: 0 0 0 0 #FFF;
        }
    
        100% {
        box-shadow: 0 0 0 14px #00000000;
        }
    }

    .loaderWrapper {
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100dvh;
        width: 100dvw;
        z-index: 999;
        background-color: #316C40;
    }
</style>