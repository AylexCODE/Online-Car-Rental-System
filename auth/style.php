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
    
    body {
        height: 100dvh;
        width: 100dvw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-image: url("../home/images/backgrounds/signupBG.jpg");
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }
    
    body > h2 {
        color: #FDFFF6;
        font-size: 32px;
        margin-bottom: 5px;
    }
    
    body > p {
        color: #FDFFF6;
        font-size: 14px;
        margin-bottom: 25px;
    }
    
    body > h2, body > p {
        position: relative;
        bottom: 20px;
    }
    /*031A09
    316C40
    294E28
    E2F87B
    FDFFF6*/
    form {
        position: relative;
        bottom: 20px;
        width: 325px;
        height: 340px;
        outline: 1px solid #294E28;
        border-radius: 12px;
        padding-block: 30px;
        padding-inline: 25px;
        /*transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);*/
        backdrop-filter: blur(5px);
        color: #FDFFF6;
        transition: all 0.2s ease;
        overflow: hidden;
    }
    
    .stepsWrapper {
        position: relative;
        height: 219px;
        right: 0px;
        display: flex;
        flex-direction: row;
        transition: all 0.2s ease;
    }
    
    label {
        font-size: 16px;
        position: relative;
        transform: translate(7px, -30px);
        height: 19px;
        color: #FDFFF690;
        pointer-events: none;
        transition: all 0.2s;
    }
    
    input {
        outline: none;
        border: 1px solid #00000000;
        border-radius: 6px;
        padding-top: 16px;
        padding-bottom: 4px;
        padding-inline: 5px;
        font-size: 16px;
        background-color: #FDFFF615;
        color: #FDFFF6;
    }
    
    input:-webkit-autofill {
        -webkit-background-clip: text;
        -webkit-text-fill-color: #ffffff;
        box-shadow: inset 0 0 20px 20px #FDFFF615;
    }
    
    input:not(#firstname, #lastname):focus + label, input:not(:placeholder-shown, #dob, #firstname, #lastname) + label, #firstname:focus ~ label:nth-child(3), #firstname:not(:placeholder-shown) ~ label:nth-child(3), #lastname:focus ~ label:nth-child(4), #lastname:not(:placeholder-shown) ~ label:nth-child(4){
        font-size: 12px;
        transform: translate(5.9px, -38px);
    }
    
    input:not(:placeholder-shown), .dobNotEmpty{
        border-bottom: 2px solid #031A09;
        border-right: 2px solid #031A09;
    }
    
    input:focus{
        border: 1px solid #FDFFF6;
    }
    
    .fullName {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto auto;
    }
    
    .fullName > input {
        width: 135px;
    }
    
    .fullName > input:nth-child(2), .fullName > label:nth-child(4){
        margin-left: 4.5px;
    }
    
    #doB {
        background-color: #FDFFF615;
        padding-inline: 0px;
        padding-bottom: 2px;
    }
    
    .dobNotEmpty + label {
        font-size: 12px;
        transform: translate(5px, -38px);
    }
    
    #cPass {
        margin-top: 10px;
    }
    
    .firstStep, .secondStep, .lastStep {
        display: flex;
        flex-direction: column;
        margin-right: 50px;
        animation: slideLeft 1s;
    }
    
    .firstStep > h4, .secondStep > h4, .lastStep > h4 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .secondStep, .lastStep {
        visibility: hidden;
        transition: all 1s;
    }
    
    .lastStep > input:not(:nth-last-child(2)), .lastStep > label:not(:last-child) {
        color: #FDFFF680;
        border-color: #FDFFF680;
    }
    
    .navigation {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    
    .nextButton, .previousButton {
        border: 1px solid #FDFFF6;
        border-radius: 6px;
        padding-block: 6px;
        width: 34%;
        background-color: #FDFFF615;
        color: white;
        font-weight: 500;
        text-align: center;
    }
    
    .previousButton {
        border: none;
        background-color: #FDFFF615;
        color: #FDFFF6;
        font-weight: normal;
        opacity: 0;
        transition: all 0.2s ease;
    }
    
    .loginButton {
        position: relative;
        top: 20px;
        display: flex;
        flex-direction: row;
    }
    
    .loginButton > a, .loginButton > a:visited, .loginButton > p {
        color: #FDFFF6;
        font-size: 14px;
        position: relative;
        bottom: 20px;
    }
    
    .progress {
        position: relative;
        left: 10px;
        height: 5px;
        width: 255px;
        border: 1px solid #FDFFF615;
        overflow: hidden;
    }
    
    .progressBar {
        display: block;
        width: 33.3%;
        height: 5px;
        background-color: #00CC0050;
        animation: loadProgress 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    #errorMsg {
        color: #E00;
        width: 275px;
        height: 1rem;
        margin-top: 5px;
        margin-bottom: 5px;
        font-size: 12px;
        text-align: center;
    }
    
    @keyframes loadProgress {
        from{
            width: 0%;
        }
        to{
            width: 33.3%;
        }
    }
</style>
