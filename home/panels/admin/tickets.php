<?php
    echo "<div class='tickets'>
            <h4>Customer Support</h4>
            <span>
                <span>
                    <span class='userAccounts'>
                        <span class='userFilterWrapper'>
                            <p>Sort by: </p>
                            <select id='userFilter'>
                                <option value='Newest'>Newest</option>
                                <option value='Oldest'>Oldest</option>
                                <option value='Alphabet'>Alphabet</option>
                            </select>
                        </span>
                        <span>
                            <label>Customer Name</label>
                            <input type='text'>
                        </span>
                        <span class='userChats'>
                            <button class='newChatsToggle' onclick='toggleNewChats()'><span>&#x290F;</span>&nbsp;New Chats</button>
                            <span id='newChats'>";
                                echo "<span onclick='getChats(&#x27;open&#x27;);'>
                                    <span class='profilePic'>A</span>
                                    <span class='userInfo'>
                                        <p>Lex</p>
                                        <p>Hey</p>
                                    </span>
                                </span>";
                            echo "</span>
                            <button class='existingChatsToggle' onclick='toggleRecentChats()'><span>&#x290F;</span>&nbsp;Recent Chats</button>
                            <span id='existingChats'>";
                                echo "<span onclick='getChats(&#x27;open&#x27;);'>
                                    <span class='profilePic'>A</span>
                                    <span class='userInfo'>
                                        <p>Lex</p>
                                        <p>Hey</p>
                                    </span>
                                </span>";
                            echo "</span>
                        </span>
                    </span>
                    <span class='messagingWrapper'>
                        <div>
                            <span>
                                <span class='profilePic'>A</span>
                                <span class='userInfo'>
                                    <p>Lex</p>
                                    <p>lex@gmail.com</p>
                                </span>
                            </span>
                            <button onclick='getChats(&#x27;close&#x27;);'>
                                <p style='font-size: 26px;'>&#x27A5;</p>
                            </button>
                        </div>
                        <div id='messages'>
                            <p class='customerMsg'>Hey</p>
                            <p class='adminMsg'>Bro</p>
                        </div>
                        <div class='messagingActions'>
                            <textarea id='message' spellcheck='false'></textarea>
                            <button><img src='./images/icons/send-icon.svg' height='16px' width='16px'></button>
                        </div>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript">
    function getChats(action){
        if(action == "close"){
            document.querySelector(".messagingWrapper").style.width = "0%";
            document.querySelector(".userAccounts").style.width = "100%";
        }else{
            document.querySelector(".messagingWrapper").style.width = "65%";
            document.querySelector(".userAccounts").style.width = "35%";
        }
    }

    function toggleNewChats(){
        document.querySelector(".newChatsToggle").classList.toggle("showing");

        if(document.querySelector(".newChatsToggle").classList.contains("showing")){
            document.getElementById("newChats").style.display =  "none";
        }else{
            document.getElementById("newChats").style.display = "flex";
        }
    }

    function toggleRecentChats(){
        document.querySelector(".existingChatsToggle").classList.toggle("showing");

        if(document.querySelector(".existingChatsToggle").classList.contains("showing")){
            document.getElementById("existingChats").style.display =  "none";
        }else{
            document.getElementById("existingChats").style.display = "flex";
        }
    }

    document.getElementById("message").addEventListener('input', () => { if(document.getElementById("message").scrollHeight <= 300){document.getElementById("message").style.height = "36px"; document.getElementById("message").style.height = document.getElementById("message").scrollHeight+2 + "px";}} );
</script>

<style type="text/css">
    .tickets {
        height: 100%;
    }

    .tickets > span {
        height: 100%;
        padding: 0px 25px 10px 25px;
    }

    .tickets > span > span {
        display: flex;
        flex-direction: row;
        gap: 5px;
        height: 100%;
    }

    .userAccounts {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: #316C40;
        height: 100%;
        width: 100%;
        border-radius: 5px;
        padding: 15px 15px;
        transition: all 1s cubic-bezier(0.215, 0.610, 0.355, 1);
    }

    .userFilterWrapper {
        display: flex;
        flex-direction: row;
        justify-content: left;
    }
    
    .userFilterWrapper > p {
        font-size: 15px;
        opacity: 0.8;
    }
    
    #userFilter {
        font-size: 15px;
        text-align: center;
        outline: none;
        background-color: transparent;
        border: none;
        color: #FDFFF6;
        padding-right: 5px;
        padding-left: 2.5px;
    }

    #userFilter * {
        background-color: #294E28;
    }

    .userAccounts > span:nth-child(2) {
        padding-bottom: 10px;
        border-bottom: 1px solid #FDFFF660;
        display: flex;
        flex-direction: column;
    }

    .userAccounts > span:nth-child(2) > label {
        font-size: 12px;
        opacity: 0.8;
    }
    .userAccounts > span:nth-child(2) > input{
        margin-top: 2px;
        width: 100%;
        outline: none;
        border: 1px solid #E2F87B;
        background-color: transparent;
        border-radius: 5px;
        padding: 5px;
        color: #FDFFF6;
    }

    .userChats {
        display: flex;
        flex-direction: column;
        justify-content: left;
        width: 100%;
        height: 100%;
    }

    .userChats > .newChatsToggle, .userChats > .existingChatsToggle {
        background-color: transparent;
        outline: none;
        border: none;
        color: #FDFFF6;
        text-align: left;
        display: flex;
        flex-direction: row;
        align-items: center;
        height: 39px;
    }
    
    .userChats > .newChatsToggle > span, .userChats > .existingChatsToggle > span {
        transition: all 1s cubic-bezier(0.19, 1, 0.22, 1);
        transform: rotate(90deg);
    }
    
    .userChats > .newChatsToggle.showing > span, .userChats > .existingChatsToggle.showing > span {
        text-align: center;
        display: block;
        width: fit-content;
        transform: rotate(0deg);
    }

    #newChats, #existingChats {
        display: flex;
        min-height: 0%;
        max-height: 50%;
        width: 100%;
        padding-left: 10px;
        padding-bottom: 10px;
    }

    .messagingWrapper {
        display: block;
        width: 0%;
        overflow: hidden;
        height: 100%;
        background-color: #316C40;
        border-radius: 5px;
        transition: all 1s cubic-bezier(0.215, 0.610, 0.355, 1);
    }

    .messagingWrapper > div:nth-child(1) {
        padding: 10px 20px;
    }

    .messagingWrapper > div:nth-child(1), .messagingWrapper > div:nth-child(1) > span {
        height: 60px;
        width: 100%;
        border-bottom: 1px solid #FDFFF660;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .profilePic {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background-color: #38814a;
    }
    
    .userInfo {
        padding-left: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .userInfo > p:nth-child(2){
        opacity: 0.8;
        font-size: 14px;
    }

    .messagingWrapper > div:nth-child(1) > button {
        background-color: transparent;
        outline: none;
        border: none;
        color: #FDFFF6;
    }

    #newChats > span, #existingChats > span {
        display: flex;
        flex-direction: row;
    }

    #messages {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: calc(100% - 120px);
        align-items: center;
        padding: 10px 20px;
    }

    #messages > .customerMsg {
        align-self: flex-start;
        background-color: #38814a;
        border-radius: 10px 10px 10px 0px;
        padding: 7.5px 15px;
    }

    #messages > .adminMsg {
        align-self: flex-end;
        background-color: #294E28;
        border-radius: 10px 10px 0px 10px;
        padding: 7.5px 15px;
    }

    .messagingActions {
        display: flex;
        flex-direction: row;
        border-top: 1px solid #FDFFF660;
        width: 100%;
        height: 60px;
        padding: 10px 15px;
        align-items : center;
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

        &::-webkit-scrollbar-thumb{
            background:rgb(103, 221, 133);
            border-radius: 2.5px 10px 10px 2.5px;
        }

        overflow-y: scroll;
        text-wrap: wordwrap;
    }

    .messagingActions::selection {
        background: #000;
    }
</style>