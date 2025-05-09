<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            *{
              padding: 0px;
              margin: 0px;
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
            }
        </style>
        <title>Forgot Password</title>
    </head>
    <body>
        <form>
            <p>Enter your email and we'll send a verification code</p>
            <span>
                <input type="email">
                <button onclick="sendCode();">Send Code</button>
            </span>
            <p>Enter Code</p>
            <input type="text">
        
            <button>Submit</button>
        </form>
    </body>
</html>
<script type="text/javascript">
    
</script>