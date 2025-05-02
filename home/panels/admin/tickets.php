<?php
    echo "<div class='tickets'>
            <h4>Customer Support</h4>
            <span>
                <span>
                    <span class='userAccounts'>
                        <span class='userFilterWrapper'>
                            <span>
                                <p>Filter by: </p>
                                <select id='userFilterStatus'>
                                    <option value='Read'>Read</option>
                                    <option value='Unread'>Unread</option>
                                    <option value='Open'>Open</option>
                                    <option value='Resolved'>Resolved</option>
                                </select>
                            </span>
                            <span>
                                <p>Sort by: </p>
                                <select id='userFilter'>
                                    <option value='Newest'>Newest</option>
                                    <option value='Oldest'>Oldest</option>
                                    <option value='Alphabet'>Alphabet</option>
                                </select>
                            </span>
                        </span>
                        <span>
                            <label>Customer Name</label>
                            <input type='text'>
                        </span>
                        <span class='userChats'>
                            <button class='newChatsToggle' onclick='toggleNewChats()'><span>&#x290F;</span>&nbsp;New Chats</button>
                            <span id='newChats'>
                                <span onclick='getChats(2);'>
                                    <span class='profilePic'>A</span>
                                    <span class='userInfo'>
                                        <p>Lex</p>
                                        <p>Hey</p>
                                    </span>
                                </span>
                            </span>
                            <button class='existingChatsToggle' onclick='toggleRecentChats()'><span>&#x290F;</span>&nbsp;Recent Chats</button>
                            <span id='existingChats'>
                                <span onclick='getChats(1);'>
                                    <span class='profilePic'>A</span>
                                    <span class='userInfo'>
                                        <p>Lex</p>
                                        <p>Hey</p>
                                    </span>
                                </span>
                            </span>
                        </span>
                    </span>
                    <span class='messagingWrapper'>
                        <div>
                            <span>
                                <span class='currentProfilePic'>A</span>
                                <span class='currentUserInfo'>
                                    <p>Lex</p>
                                    <p>lex@gmail.com</p>
                                </span>
                            </span>
                            <button id='chatCloseBtn'>
                                <p style='font-size: 26px;'>&#x27A5;</p>
                            </button>
                        </div>
                        <div id='messages'>
                            <p class='customerMsg'>Hey</p>
                            <p class='adminMsg'>Bro</p>
                        </div>
                        <div class='messagingActions'>
                            <textarea id='message' spellcheck='false'></textarea>
                            <button onclick='sendMsgAdmin(document.getElementById(&#x27;message&#x27;).value);'><img src='./images/icons/send-icon.svg' height='16px' width='16px'></button>
                        </div>
                    </span>
                </span>
            </span>
        </div>";
?>

<script type="text/javascript" src="./scripts/messaging.js"></script>
<script type="text/javascript">
    let chatToggle = true, currentUser = 0;
    function getChats(user){
        if(!chatToggle){
            document.querySelector(".messagingWrapper").style.width = "0%";
            document.querySelector(".userAccounts").style.width = "100%";
            
            chatToggle = true;
        }else{
            document.querySelector(".messagingWrapper").style.width = "65%";
            document.querySelector(".userAccounts").style.width = "35%";
            
            getMessages(user, "admin");
            
            chatToggle = false;
        }
        
        if(user != currentUser && chatToggle){
            setTimeout(() => {
                getChats(user);
            }, 500);
        }
        currentUser = user;
        document.getElementById("chatCloseBtn").onclick = () => {getChats(user)}
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
    
    function getCustomerList(){
        $.ajax({
            type: 'get',
            url: './queries/user/getCustomerSupport.php',
            success: function(res){
                sortCustomerChats(JSON.parse(res));
            },
            error: function(){}
        });
    }
    
    function sortCustomerChats(customers){
        let newChats = "", recentChats = "";
        
        const customersArray = Object.entries(customers);
        for(let i = 1; i < customersArray.length; i++){
            const msg = Object.entries(customersArray[i][1].convo);
            const lastMsg = Object.entries(msg[msg.length - 1])[1][1];

            if(JSON.stringify(customersArray[i][1].convo).includes("admin")){
              recentChats += `<span onclick='getChats(${customersArray[i][1].id}); setCurrentChatInfo(&#x27;${customersArray[i][1].name}&#x27;, &#x27;${customersArray[i][1].email}&#x27;);'>
                                    <span class='profilePic'>${customersArray[i][1].name.substr(0, 1)}</span>
                                    <span class='userInfo'>
                                        <p>${customersArray[i][1].name}</p>
                                        <p>${lastMsg.m}</p>
                                    </span>
                                </span>
                           </span>`;
            }else{
              newChats += `<span onclick='getChats(${customersArray[i][1].id}); setCurrentChatInfo(&#x27;${customersArray[i][1].name}&#x27;, &#x27;${customersArray[i][1].email}&#x27;);'>
                                    <span class='profilePic'>${customersArray[i][1].name.substr(0, 1)}</span>
                                    <span class='userInfo'>
                                        <p>${customersArray[i][1].name}</p>
                                        <p>${lastMsg.m}</p>
                                    </span>
                                </span>
                           </span>`;
            }
        }
        
        document.getElementById("existingChats").innerHTML = recentChats;
        document.getElementById("newChats").innerHTML = newChats;
    }
    
    function sendMsgAdmin(msg){
        sendMessageAdmin("admin", msg, currentUser);
        getCustomerList();
    }
    
    function setCurrentChatInfo(name, email){
        document.querySelector(".currentProfilePic").innerHTML = name.substr(0, 1);
        document.querySelector(".currentUserInfo > p:first-child").innerHTML = name;
        document.querySelector(".currentUserInfo > p:last-child").innerHTML = email;
    }

    document.getElementById("newChats").innerHTML = "";
    document.getElementById("existingChats").innerHTML = "";
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
        flex-wrap: wrap;
        gap: 10px;
    }

    .userFilterWrapper > span {
        display: flex;
        flex-direction: row;
        justify-content: left;
    }
    
    .userFilterWrapper  p {
        font-size: 15px;
        opacity: 0.8;
    }
    
    #userFilter, #userFilterStatus {
        font-size: 15px;
        text-align: left;
        outline: none;
        background-color: transparent;
        border: none;
        color: #FDFFF6;
        padding-right: 5px;
        padding-left: 2.5px;
    }

    #userFilter *, #userFilterStatus * {
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
        text-align: center;
        display: block;
        width: fit-content;
        height: 28px;
    }
    
    .userChats > .newChatsToggle.showing > span, .userChats > .existingChatsToggle.showing > span {
        transform: rotate(0deg);
    }

    #newChats, #existingChats {
        display: flex;
        flex-direction: column;
        gap: 15px;
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

    .profilePic, .currentProfilePic {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background-color: #38814a;
    }
    
    .userInfo, .currentUserInfo {
        padding-left: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .userInfo > p:nth-child(2), .currentUserInfo > p:nth-child(2){
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
        overflow-y: scroll;
        padding: 10px 15px;
        
        &::-webkit-scrollbar {
          display: block;
          width: 10px;
          background-color: #38814a;
        }
        
        &::-webkit-scrollbar-thumb {
          background: rgb(103, 221, 133);
        }
    }

    #messages > .customerMsg {
        align-self: flex-start;
        background-color: #38814a;
        border-radius: 10px 10px 10px 0px;
        padding: 7.5px 15px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    #messages > .adminMsg {
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