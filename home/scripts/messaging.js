const message = document.getElementById("message");
let jsonMessages = {}, numberOfMessages = 0;

function sendMessage(role, msg) {
    const date = new Date();
    const now = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear() + " " +(date.getHours() > 9 ? date.getHours() : "0"+date.getHours()) + ":" +(date.getMinutes() > 9 ? date.getMinutes() : "0"+date.getMinutes() );
  
    jsonMessages['m' + (numberOfMessages + 1)] = {
                                                     t: role,
                                                     m: msg.replaceAll('"', "&quot;"),
                                                     d: now
                                                 };
  
    $.ajax({
        type: 'post',
        url: './queries/user/sendMessage.php',
        data: { ddata: JSON.stringify(jsonMessages), role: role },
        success: function(res) {
            getMessages(document.getElementById("messages").className);
            message.value = "";
            message.style.height = "36px";
        },
        error: function() {}
    });
}

async function sendMessageAdmin(role, msg, userID) {
    const date = new Date();
    const now = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear() + " " +(date.getHours() > 9 ? date.getHours() : "0"+date.getHours()) + ":" +(date.getMinutes() > 9 ? date.getMinutes() : "0"+date.getMinutes() );
  
    jsonMessages['m' + (numberOfMessages + 1)] = {
                                                     t: role,
                                                     m: msg.replaceAll('"', "&quot;"),
                                                     d: now
                                                 };
  
    await $.ajax({
        type: 'post',
        url: './queries/user/sendMessage.php',
        data: { ddata: JSON.stringify(jsonMessages), role: role, userID : userID },
        success: function(res) {
            getMessages(userID);
            message.value = "";
            message.style.height = "36px";
        },
        error: function() {}
    });
}

function getMessages(userID, type) {
    $.ajax({
        type: 'get',
        url: './queries/user/getMessages.php?userid=' + userID,
        success: function(res) {
          if (res) formatMessages(res, type);
        },
        error: function(error) {}
    });
}

function formatMessages(messages, type) {
    const retrievedMsg = JSON.parse(messages);
    jsonMessages = retrievedMsg;
  
    numberOfMessages = Object.keys(retrievedMsg).length;
  
    let messagesHtml = "";
    const messagesArray = Object.entries(retrievedMsg);
    let prevMsgTime = new Date();
    for (let i = 0; i < messagesArray.length; i++) {
        if (messagesArray[i][0] == "status" && type == "") continue;
    
        const currentMsgTime = new Date(messagesArray[i][1].d);
    
        if (((currentMsgTime.getTime() - prevMsgTime.getTime()) / 1000 / 60) > 10 || i == 0) messagesHtml += `<p class='msgTime'>${formatDateTime(messagesArray[i][1].d)}</p>`;
        messagesHtml += `<p class='${messagesArray[i][1].t}Msg'>`;
        messagesHtml += messagesArray[i][1].m;
        messagesHtml += "</p>";
    
        prevMsgTime = currentMsgTime;
    }
  
    document.getElementById("messages").innerHTML = messagesHtml;
    document.getElementById("messages").scrollTop = document.getElementById("messages").scrollHeight;
}

function formatDateTime(dateTime){
    const monthYearDay = dateTime.split(" ")[0];
    const month = monthYearDay.split("/")[0];
    const year = monthYearDay.split("/")[2];
    const date = monthYearDay.split("/")[1];
    
    const time = dateTime.split(" ")[1];
    let hour = time.split(":")[0];
    const minute = time.split(":")[1];
    
    let monthInWords, formattedTime, meridiem = "AM";

    switch(month){
        case "1":
            monthInWords = "January";
            break;
        case "2":
            monthInWords = "February";
            break;
        case "3":
            monthInWords = "March";
            break;
        case "4":
            monthInWords = "April";
            break;
        case "5":
            monthInWords = "May";
            break;
        case "6":
            monthInWords = "June";
            break;
        case "7":
            monthInWords = "July";
            break;
        case "8":
            monthInWords = "August";
            break;
        case "9":
            monthInWords = "September";
            break;
        case "10":
            monthInWords = "October";
            break;
        case "11":
            monthInWords = "November";
            break;
        case "12":
            monthInWords = "December";
            break;
        default:
            monthInWords = "Error";
    }
    
    if(hour > 12){
        hour-=12;
        meridiem = "PM";
    }
    
    return `${monthInWords} ${date}, ${year} ${hour}:${minute}${meridiem}`;
}

document.getElementById("messages").innerHTML = "";
document.getElementById("message").addEventListener('input', () => { if (document.getElementById("message").scrollHeight <= 300) { document.getElementById("message").style.height = "36px";
document.getElementById("message").style.height = document.getElementById("message").scrollHeight + 2 + "px"; } });