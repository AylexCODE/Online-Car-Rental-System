<style type="text/css">
    @font-face{
      font-family: space-grotesk-regular;
      url: ("../fonts/SpaceGrotesk-Regular.otf");
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
    }
    
    form {
        width: 325px;
        border: 2px solid black;
        border-radius: 12px;
        padding-block: 30px;
        padding-inline: 25px;
    }
    
    label {
        font-size: 16px;
        position: relative;
        transform: translate(7px, -30px);
        height: 19px;
        pointer-events: none;
        transition: all 0.2s;
    }
    
    input {
        outline: none;
        border: 1px solid black;
        border-radius: 6px;
        padding-top: 16px;
        padding-bottom: 4px;
        padding-inline: 5px;
        font-size: 16px;
    }
    
    input:not(#firstname, #lastname, #doB):focus + label, input:not(:placeholder-shown, #dob) + label, #firstname:focus ~ label:nth-child(3), #firstname:not(:placeholder-shown) ~ label:nth-child(3), #lastname:focus ~ label:nth-child(4), #lastname:not(:placeholder-shown) ~ label:nth-child(4){
        font-size: 12px;
        transform: translate(5.9px, -38px);
    }
    
    input:not(:placeholder-shown, .dob), .dobNotEmpty{
        border-bottom: 1px solid green;
        border-right: 1px solid green;
    }
    
    input:focus{
        border-bottom: 1px solid purple;
        border-right: 1px solid purple;
    }
    
    .fullName {
        width: 100%;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto auto;
    }
    
    .fullName > input {
        width: 134px;
    }
    
    .fullName > input:nth-child(2), .fullName > label:nth-child(4){
        margin-left: 2.5px;
    }
    
    #doB {
        width: 100%;
        background-color: transparent;
        padding-inline: 0px;
        padding-bottom: 2px;
    }
    
    #doB:focus{
        border-bottom: 1px solid purple;
        border-right: 1px solid purple;  
    }
    
    .dobNotEmpty + label {
        font-size: 12px;
        transform: translate(5px, -38px);
    }
    
    .firstStep, .secondStep, .lastStep {
        display: none;
        flex-direction: column;
    }
    
    .lastStep > input:not(:nth-last-child(2)), .lastStep > label:not(:last-child) {
        color: #00000080;
        border-color: #00000080;
    }
    
    .navigation {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    
    .nextButton, .previousButton {
        border: 1px solid black;
        border-radius: 6px;
        padding-block: 6px;
        width: 35%;
        background-color: black;
        color: white;
        font-weight: 500;
        text-align: center;
    }
    
    .previousButton {
        border: 1px solid black;
        background-color: white;
        color: black;
        font-weight: normal;
    }
    
    .loginButton {
        position: relative;
        top: 10px;
        display: flex;
        flex-direction: row;
    }
    
    .loginButton > a, .loginButton > a:visited, .loginButton > p {
        color: black;
        font-size: 14px;
    }
    
    .show {
        display: flex;
    }
</style>