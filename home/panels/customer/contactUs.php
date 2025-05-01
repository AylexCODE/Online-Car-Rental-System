<?php
    echo "<div class='contactPage'>
            <span class='contactInfo'></span>
            <span class='chatWAdmin' >
                <span>
                    <p style='font-family: space-grotesk-semibold; font-size: 24px; text-transform: uppercase;'>Chat With Customer Support</p>
                    <span>
                        <div id='userMessages' class='" . $_SESSION["userID"] . "'>
                            <p class='customerMsg'>Hey</p>
                            <p class='adminMsg'>Bro</p>
                        </div>
                        <div class='messagingActions'>
                           <textarea id='userMessage' spellcheck='false'></textarea>
                           <button onclick='sendMessage(&#x27;customer&#x27;);'><img src='./images/icons/send-icon.svg' height='16px' width='16px'></button>
                        </div>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript">
    const messageToSend = document.getElementById("userMessage");
    let jsonMessages = {}, numberOfMessages = 0;
    
    function sendMessage(role){
        const date = new Date();
        const now = (date.getMonth()+1) +"/" +date.getDate() +"/" +date.getFullYear() +" " +date.getHours() +":" +date.getMinutes();
        try{
        jsonMessages['m'+(numberOfMessages+1)] = {
                                                     t: role,
                                                     m: messageToSend.value.replaceAll('"', "&quot;"),
                                                     d: now
                                                 };
        
        $.ajax({
            type: 'post',
            url: './queries/user/sendMessage.php',
            data: { ddata: JSON.stringify(jsonMessages) },
            success: function(res){
              console.log(res)
                getMessages(document.getElementById("userMessages").className);
                messageToSend.value = "";
                document.getElementById("userMessage").style.height = "36px";
            },
            error: function(){}
        });
        }catch(e){
          console.log(e)
        }
    }
    
    function getMessages(userID){
        $.ajax({
            type: 'get',
            url: './queries/user/getMessages.php?userid=' +userID,
            success: function(res){
              console.log(res)
                if(res) formatMessages(res);
            },
            error: function(error){}
        });
    }

    function formatMessages(messages){
        const retrievedMsg = JSON.parse(messages);
        jsonMessages = retrievedMsg;
        
        numberOfMessages = Object.keys(retrievedMsg).length;
        
        let messagesHtml = "";
        const messagesArray = Object.entries(retrievedMsg);
        let prevMsgTime = new Date();
        for(let i = 0; i < messagesArray.length; i++){
            if(messagesArray[i][0] == "status") continue;
            
            const currentMsgTime = new Date(messagesArray[i][1].d);
            
            if(((currentMsgTime.getTime() - prevMsgTime.getTime()) / 1000 / 60) > 10 || i == 1) messagesHtml += `<p class='msgTime'>${messagesArray[i][1].d}</p>`;
            messagesHtml += `<p class='${messagesArray[i][1].t}Msg'>`;
            messagesHtml += messagesArray[i][1].m;
            messagesHtml += "</p>";
            
            prevMsgTime = currentMsgTime;
        }
        
        document.getElementById("userMessages").innerHTML = messagesHtml;
    }
    
    getMessages(document.getElementById("userMessages").className);
   
    document.getElementById("userMessages").innerHTML = "";
    document.getElementById("userMessage").addEventListener('input', () => { if (document.getElementById("userMessage").scrollHeight <= 300) { document.getElementById("userMessage").style.height = "36px"; document.getElementById("userMessage").style.height = document.getElementById("userMessage").scrollHeight + 2 + "px"; } });
</script>

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
        width: 60%;
        height: 70%;
    }
    
    .chatWAdmin > span > span {
        display: block;
        width: 100%;
        height: 100%;
        border: 1px solid #E2F87B;
        border-radius: 15px;
        padding: 20px 20px;
    }
    
    #userMessages {
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

    #userMessages > .customerMsg {
        align-self: flex-start;
        background-color: #38814a;
        border-radius: 10px 10px 10px 0px;
        padding: 7.5px 15px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    #userMessages > .adminMsg {
        align-self: flex-end;
        background-color: #294E28;
        border-radius: 10px 10px 0px 10px;
        padding: 7.5px 15px;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    
    #userMessages > .msgTime {
        opacity: 0.8;
        font-size: 12px;
        margin-bottom: 5px;
    }
    
    #userMessages > .msgTime:not(:first-child) {
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
  
    #userMessage {
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