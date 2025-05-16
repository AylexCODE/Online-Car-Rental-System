<?php
    session_start();

    require("../database/db_conn.php");
    require_once("../home/queries/record_logs.php");

    if(isset($_POST["login"])){
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $rememberMe = filter_input(INPUT_POST, "rememberMe", FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "SELECT UserID, Name, Email, Role, Password FROM users WHERE Email = '$contact' OR PhoneNumber = '$contact'";
        $execQuery = mysqli_query($conn, $query);

        if(mysqli_num_rows($execQuery) != 0){
            $rows = mysqli_fetch_assoc($execQuery);

            $_SESSION["TempEmail"] = $rows["Email"];
            if(password_verify($password, $rows["Password"])){
                unset($_SESSION["TempEmail"]);
                $_SESSION["name"] = $rows["Name"];
                $_SESSION["email"] = $rows["Email"];
                $_SESSION["role"] = $rows["Role"];
                $_SESSION["userID"] = $rows["UserID"];
                recordLog($rows["UserID"], "Login", $conn);
                
                header("location: ../home/index.php");
            }else{
                header("location: ./login.php?authfailed");
            }
        }else{
            session_unset();
            session_destroy();
            header("location: ./login.php?accountnotfound");
        }
    }
    
    include_once("../home/animations.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        
        @font-face{
            font-family: space-grotesk-regular;
            url: ("../fonts/SpaceGrotesk-Regular.otf");
            src: url("../fonts/SpaceGrotesk-Regular.otf");
        }
        
        body {
            background-image: url("../home/images/backgrounds/loginBG.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: space-grotesk-regular;
            color: #FDFFF6;
            display: grid;
            place-items: center;
            height: 100vh;
        }

        input:-webkit-autofill {
            -webkit-background-clip: text;
            -webkit-text-fill-color: #ffffff;
            box-shadow: inset 0 0 20px 20px #FDFFF615;
        }

        .loginWrapper {
            background-color: #031A0965;
            padding: 40px 50px 30px 50px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(5px);
        }
        
        .loginWrapper form {
            display: flex;
            flex-direction: column;
        }

        .loginWrapper h2 {
            margin-bottom: 20px;
            align-self: center;
        }

        .loginWrapper input {
            color: #E2F87B;
            padding: 10px;
            border: 1px solid #E2F87B70;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 15px;
            background-color: #FFFFFF30;
            border-bottom: 2px solid #45a049;
            border-right: 2px solid #45a049;
        }
        
        .loginWrapper #password {
            padding-inline: 10px 30px;
        }
        
        .loginWrapper label {
            margin-bottom: 2.5px;
        }
        
        .loginWrapper span {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        
        .loginWrapper span img {
            margin-right: 15px;
            transform: translateY(34px);
        }
        
        .animationForIcon {
            height: 16px;
            width: 16px;
            transform: translate(16px, 34px);
            z-index: 10;
            display: grid;
            place-items: center;
            pointer-events: none;
        }
        
        #animateIcon {
            border-radius: 50%;
            display: block;
            height: 16px;
            width: 16px;
            scale: 0;
            background-color: #FDFFF6;
            border: 1px solid #E2F87B;
            opacity: 1;
            transition: all 1s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        /*
        .animateIconn {
            animation: scaleUp 1s 
        }
        
        .animateIconn.reverse {
            animation: scaleUp 1s cubic-bezier(0.25, 0.8, 0.25, 1);
            animation-direction: reverse;
        }*/

        .loginWrapper button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .loginWrapper button:hover {
            background-color: #45a049;
        }

        .loginWrapper a, .loginWrapper:visited {
            color: #E2F87B;
            text-decoration: none;
            align-self: center;
        }

        .loginWrapper a:hover {
            text-decoration: underline;
        }
        
        .utilityWrapper {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }
        
        .utilityWrapper > span {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 20px;
        }
        
        .utilityWrapper > span:nth-child(1){
            gap: 3px;
        }
        
        .utilityWrapper input {
            transform: translateY(7px);
        }
        
        .utilityWrapper a, utilityWrapper a:visited {
            color: #4CAF50;
            transform: translateY(-1.4px);
        }
        
        form > p {
            width: 100%;
            text-align: center;
        }
        
        .errorMsg, .successMsg {
            color: #f44336;
            margin-block: 5px 10px;
            align-self: center;
        }
        
        .successMsg {
            color: #E2F87B;
        }
        
        @keyframes scaleUp {
            0%{
              scale: 0;
              background-color: #FDFFF6;
              border: 1px solid #E2F87B;
              opacity: 1;
            }
            90%{
              background-color: #FDFFF6;
              border: 1px solid #E2F87B;
            }
            100%{
              scale: 2;
              background-color: transparent;
              border: 1px solid #E2F87B;
              opacity: 0;
            }
        }
    </style>
    <title>Car Rental</title>
</head>
<body>
     <div class="loginWrapper">
        <h2>Login</h2>
        <form method="post">
            <label for="contact">Email or Phone</label>
            <input type="text" name="contact" id="contact" spellcheck="false" value="<?php if(isset($_SESSION["TempEmail"])) echo $_SESSION["TempEmail"]; ?>" required>

            <span>
                <label for="password">Password</label>
                <span>
                    <span class="animationForIcon">
                        <span id="animateIcon"></span>
                    </span>
                    <img src="../home/images/icons/hidePassword-icon.svg" onclick="togglePassword();" id="passwordToggleIcon" height="16px" width="16px">
                </span>
            </span>
            <input type="password" name="password" id="password" required>
            <span class="utilityWrapper">
                <span>
                    <input type="checkbox" id="rememberMeBtn" name="rememberMe" onchange="rememberMe(this.value);">
                    <label for="rememberMeBtn">Remember Me</label>
                </span>
                <span>
                    <a href="./passwordReset.php">Forgot Password?</a>
                </span>
            </span>
            <button type="submit" name="login" onclick="setRemembered();" id="loginBtn">Login</button>
            
            <?php
                if(isset($_GET["authfailed"])){
                    echo "<p class='errorMsg'>Invalid Credentials</p>";
                }elseif(isset($_GET['accountnotfound'])){
                    echo "<p class='errorMsg'>Account Not Found</p>";
                }elseif(isset($_GET['accountcreated'])){
                    echo "<p class='successMsg'>Account Created</p>";
                }elseif(isset($_GET['passwordchanged'])){
                    echo "<p class='successMsg'>Password Changed Successfully</p>";
                }elseif(isset($_GET['errorpasswordchange'])){
                    echo "<p class='errorMsg'>Error Changing Password</p>";
                }else{
                    echo "<p class='successMsg' style='visibility: hidden;'>No Error</p>";
                }
            ?>
        
            <p>Don't have an account? <a href="./signup.php">Signup</a></p>
        </form>
    </div>
    <p class='msg'>Hello World!</p>
</body>
<script type="text/javascript">
    const contact = document.getElementById("contact");
    const rememberMeBtn = document.getElementById("rememberMeBtn");
    const pwd = document.getElementById("password");
    const passwordToggleIcon = document.getElementById("passwordToggleIcon");

    function togglePassword(){
        if(pwd.type == "password"){
            pwd.type = "text";
            passwordToggleIcon.src = "../home/images/icons/showPassword-icon.svg";
            document.getElementById("animateIcon").style.scale = "2";
            document.getElementById("animateIcon").style.opacity = "0";
        }else{
            pwd.type = "password";
            passwordToggleIcon.src = "../home/images/icons/hidePassword-icon.svg";
            document.getElementById("animateIcon").style.scale = "0";
            document.getElementById("animateIcon").style.opacity = "1";
        }
    }
    
    function rememberMe(isRemembered){
        if(!isRemembered){
            localStorage.removeItem("user");
        }
    }
    
    function setRemembered(){
        if(rememberMeBtn.checked){
            localStorage.setItem("user", `${contact.value}&nbsp;${pwd.value}`);
        }else{
            localStorage.removeItem("user");
        }
    }
    
    function getRemembered(){
        if(localStorage.getItem("user")){
            contact.value = localStorage.getItem("user").split("&nbsp;")[0];
            password.value = localStorage.getItem("user").split("&nbsp;")[1];
            
            document.getElementById("loginBtn").click();
        }
    }
    
    getRemembered();
</script>
</html>
