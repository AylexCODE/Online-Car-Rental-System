<?php
    echo "<div class='contactPage'>
            <span class='contactInfo'></span>
            <span class='chatWAdmin' >
                <span>
                    <p style='font-family: space-grotesk-semibold; font-size: 24px; text-transform: uppercase;'>Chat With Customer Support</p>
                    <span>
                        <div id='messages' class='"; if(isset($_SESSION["userID"])){ echo $_SESSION["userID"]; } echo"'>
                            <p class='customerMsg'>Hey</p>
                            <p class='adminMsg'>Bro</p>
                        </div>
                        <div class='messagingActions'>
                           <textarea id='message' spellcheck='false'></textarea>
                           <button onclick='sendMessage(&#x27;customer&#x27;, document.getElementById(&#x27;message&#x27;).value);'><img src='./images/icons/send-icon.svg' height='16px' width='16px'></button>
                        </div>
                    </span>
                </span>";
                if(!isset($_SESSION["userID"])){
                    echo "<span style='height: calc(70% - 32px); width: 50.7%; position: absolute; backdrop-filter: blur(2.5px); transform: translateY(20px); border-radius: 15px; background-color: #00000020;'>
                            <p style='opacity: 0.8;'>Log-in to start chatting</p>
                        </span>";
                }
            echo "</span>
        </div>";
?>

<script  src="./scripts/messaging.js"></script>

<style type="text/css">
    .contactPage {
        position: fixed;
        top: 0; left: 0;
        height: 100%;
        width: 100%;
        z-index: 90;
        background-color: #316C40;
        display: none;
        overflow-y: scroll;
        scroll-behavior: smooth;
        scroll-snap-type: y mandatory;
    }
    
    .contactInfo, .chatWAdmin {
        display: block;
        height: 100%;
        width: 100%;
        scroll-snap-align: start;
    }
    
    .chatWAdmin {
        display: grid;
        place-items: center;
        color: #FDFFF6;
    }
    
    .chatWAdmin > span {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 50%;
        height: 70dvh;
    }
    
    .chatWAdmin > span > span {
        display: block;
        width: 100%;
        height: 100%;
        border: 1px solid #E2F87B;
        border-radius: 15px;
        padding: 20px 20px;
    }
    
    #messages {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: calc(100% - 50px);
        align-items: center;
        overflow-y: scroll;
        
        &::-webkit-scrollbar {
          display: block;
          width: 10px;
          background-color: #38814a;
        }
        
        &::-webkit-scrollbar-thumb {
          background: rgb(103, 221, 133);
        }
    }

    #messages > .adminMsg {
        align-self: flex-start;
        background-color: #38814a;
        border-radius: 10px 10px 10px 0px;
        padding: 7.5px 15px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    #messages > .customerMsg {
        align-self: flex-end;
        background-color: #294E28;
        border-radius: 10px 10px 0px 10px;
        padding: 7.5px 15px;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    
    #messages > .msgTime {
        opacity: 0.8;
        font-size: 12px;
        margin-bottom: 5px;
    }
    
    #messages > .msgTime:not(:first-child) {
        margin-block: 5px;
    }

    .messagingActions {
        display: flex;
        flex-direction: row;
        border-top: 1px solid #FDFFF660;
        width: 100%;
        height: 60px;
        padding: 10px 15px;
        align-items: center;
        gap: 10px;
        justify-content: space-between;
    }

    .messagingActions > button {
        background-color: transparent;
        outline: none;
        border: 1px solid #E2F87B;
        border-radius: 50%;
        height: fit-content;
        width: fit-content;
        padding: 8px;
    }
  
    #message {
        resize: none;
        background-color: #316C40;
        width: 100%;
        outline: none;
        border: 1px solid #E2F87B;
        border-radius: 10px;
        padding: 7.5px 10px;
        color: #E2F87B;
        height: 36px;
        justify-self: flex-end;
        align-self: flex-end;
      
        &::-webkit-scrollbar {
            display: block;
            width: 10px;
            border-left: 1px solid rgba(103, 221, 133, 0.62);
        }
        
        &::-webkit-scrollbar-thumb {
            background: rgb(103, 221, 133);
            border-radius: 2.5px 10px 10px 2.5px;
        }
        
        overflow-y: scroll;
        text-wrap: wordwrap;
    }
    
    .messagingActions::selection {
        background: #000;
    }
</style>