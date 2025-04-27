<?php
    session_start();

    require("../database/db_conn.php");

    if(isset($_POST["login"])){
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "SELECT * FROM users WHERE Email = '$contact' OR PhoneNumber = '$contact'";
        $execQuery = mysqli_query($conn, $query);

        if(mysqli_num_rows($execQuery) != 0){
            $rows = mysqli_fetch_assoc($execQuery);

            $_SESSION["TempEmail"] = $rows["Email"];
            if(password_verify($password, $rows["Password"])){
                unset($_SESSION["TempEmail"]);
                $_SESSION["email"] = $rows["Email"];
                $_SESSION["role"] = $rows["Role"];
                $_SESSION["userID"] = $rows["UserID"];
                
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: url('your-background-image-url') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 40px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-container p {
            margin-bottom: 10px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #45a049; /* Darker green */
        }

        .login-container a {
            color: #4CAF50;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: #f44336;
            margin-top: 10px;
        }
    </style>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Car Rental</title>
</head>
<body>
     <div class="login-container">
        <h2>Login</h2>
        <form method="post">
            <p>Email or Phone</p>
            <input type="text" name="contact" value="<?php if(isset($_SESSION["TempEmail"])) echo $_SESSION["TempEmail"]; ?>" required>

            <p>Password</p>
            <input type="password" name="password" required>

            <br>
            <button type="submit" name="login">Login</button>

            <p>Don't have an account? <a href="./signup.php">Signup</a></p>
        </form>

        <?php
            if(isset($_GET['authfailed'])){
                echo '<p class="error-msg">Invalid login credentials.</p>';
            } elseif(isset($_GET['accountnotfound'])){
                echo '<p class="error-msg">Account not found. Please sign up.</p>';
            }
        ?>
    </div>
</body>
</html>
