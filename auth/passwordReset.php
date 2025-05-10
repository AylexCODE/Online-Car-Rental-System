<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../home/vendor/jquery-3.7.1.min.js"></script>
        <style type="text/css">
            *{
              padding: 0px;
              margin: 0px;
              font-family: space-grotesk-regular;
            }
            
            @font-face{
                font-family: space-grotesk-regular;
                url: ("../fonts/SpaceGrotesk-Regular.otf");
                src: url("../fonts/SpaceGrotesk-Regular.otf");
            }
            
            body {
                height: 100dvh;
                width: 100dvw;
                background-color: #316C40;
                display: grid;
                place-items: center;
            }
            
            body > form {
                background-color: #38814a;
                color: #FDFFF6;
                padding: 40px 30px;
                border-radius: 15px;
                display: flex;
                flex-direction: column;
                gap: 5px;
                max-width: 50%;
                width: 400px;
            }
            
            body > form > span {
                display: flex;
                flex-direction: row;
                gap: 5px;
            }
            
            body input {
                border: 1px solid #E2F87B;
                border-radius: 5px;
                background-color: transparent;
                padding: 10px 10px;
                margin-bottom: 10px;
                color: #FDFFF6;
            }
            
            body button {
                border-radius: 5px;
                border: none;
                height: 38px;
            }
            
            #contact {
                width: 100%;
            }
            
            #code {
                width: calc(100% - 20px);
            }
            
            #msg > p {
                text-align: center;
                width: 100%;
            }
            
            .success {
                color: #FDFF6;
            }
            
            .error {
                color: #E00;
            }
        </style>
        <title>Forgot Password</title>
    </head>
    <body>
        <form onsubmit="return false">
            <p>Enter your email or phone number and we'll send a verification code</p>
            <span>
                <input type="text" id="contact" required>
                <button id="sendCodeBtn" onclick="checkAccount();" style="width: 120px; background-color: transparent; border: 1px solid #E2F87B; color: #FDFFF6;">Send Code</button>
            </span>
            <p>Enter Code</p>
            <input type="text" id="code">
        
            <button style="width: 100%; background-color: #E2F87B;">Submit</button>
            <span id="msg"></span>
        </form>
    </body>
</html>
<script type="text/javascript">
    const contact = document.getElementById("contact");
    const code = document.getElementById("code");
    const sendCodeBtn = document.getElementById("sendCodeBtn");
    
    function countDown(n){
        localStorage.setItem("countDown", n-1);
        if(n >= 0){
            setTimeout(() => {
                sendCodeBtn.innerHTML = n;
                countDown(n-1);
            }, 1000);
        }else{
            sendCodeBtn.disabled = false;
            sendCodeBtn.style.opacity = 1;
            localStorage.removeItem("countDown");
            sendCodeBtn.innerHTML = "Send Code";
        }
    }
    
    function disableSendCodeBtn(){
        sendCodeBtn.disabled = true;
        sendCodeBtn.style.opacity = "0.5";
        countDown(localStorage.getItem("countDown"));
    }
    
    function sendCode(){
        localStorage.setItem("countDown", 1);
        
        disableSendCodeBtn();
        
        const chars = ['A,', 'a', 'B', 'b', 'C', 'c', 'D', 'd', 'E', 'e', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'Q', 'q', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'V', 'v', 'W', 'w', 'X', 'x', 'Y', 'y', 'Z', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        let randomCode = "";
        
        for(let i = 0; i < 6; i++){
            const rng = Math.floor(Math.random() * 63);
            randomCode += chars[rng];
        }
    }
    
    function checkAccount(){
        $.ajax({
            type: 'get',
            url: `./handler/passwordResetHandler.php?contact=${contact.value}`,
            success: function(res){
                if(res == "Ok"){
                    $("#msg").html("<p class='success'>Verification code sent!</p>");
                    sendCode();
                }else{
                    $("#msg").html(`<p class='error'>${res}</p>`);
                }
            },
            error: function(){}
        });
    }
    
    if(localStorage.getItem("countDown")){
        disableSendCodeBtn();
    }
</script>