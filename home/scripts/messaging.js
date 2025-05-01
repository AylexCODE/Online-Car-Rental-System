const message = document.getElementById("message");
let jsonMessages = {}, numberOfMessages = 0;

function sendMessage(role, msg) {
    const date = new Date();
    const now = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();
  
    jsonMessages['m' + (numberOfMessages + 1)] = {
                                                     t: role,
                                                     m: msg.replaceAll('"', "&quot;"),
                                                     d: now
                                                 };
  
    $.ajax({
        type: 'post',
        url: './queries/user/sendMessage.php',
        data: { ddata: JSON.stringify(jsonMessages) },
        success: function(res) {
            getMessages(document.getElementById("messages").className);
            message.value = "";
            message.style.height = "36px";
        },
        error: function() {}
    });
}

function getMessages(userID) {
    $.ajax({
        type: 'get',
        url: './queries/user/getMessages.php?userid=' + userID,
        success: function(res) {
          if (res) formatMessages(res);
        },
        error: function(error) {}
    });
}

function formatMessages(messages) {
    const retrievedMsg = JSON.parse(messages);
    jsonMessages = retrievedMsg;
  
    numberOfMessages = Object.keys(retrievedMsg).length;
  
    let messagesHtml = "";
    const messagesArray = Object.entries(retrievedMsg);
    let prevMsgTime = new Date();
    for (let i = 0; i < messagesArray.length; i++) {
        if (messagesArray[i][0] == "status") continue;
    
        const currentMsgTime = new Date(messagesArray[i][1].d);
    
        if (((currentMsgTime.getTime() - prevMsgTime.getTime()) / 1000 / 60) > 10 || i == 1) messagesHtml += `<p class='msgTime'>${messagesArray[i][1].d}</p>`;
        messagesHtml += `<p class='${messagesArray[i][1].t}Msg'>`;
        messagesHtml += messagesArray[i][1].m;
        messagesHtml += "</p>";
    
        prevMsgTime = currentMsgTime;
    }
  
    document.getElementById("messages").innerHTML = messagesHtml;
    document.getElementById("messages").scrollTop = document.getElementById("messages").scrollHeight;
}

document.getElementById("messages").innerHTML = "";
document.getElementById("message").addEventListener('input', () => { if (document.getElementById("message").scrollHeight <= 300) { document.getElementById("message").style.height = "36px";
document.getElementById("message").style.height = document.getElementById("message").scrollHeight + 2 + "px"; } });