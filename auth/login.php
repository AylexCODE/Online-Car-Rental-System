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
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Car Rental</title>
</head>
<body>
    <form method="post">
        <p>Email or Phone</p>
        <input type="text" name="contact" value="<?php if(isset($_SESSION["TempEmail"])) echo $_SESSION["TempEmail"]; ?>">

        <p>Password</p>
        <input type="password" name="password">

        <br>
        <button type="submit" name="login">Login</button>

        <p>Don't have an account?</p>
        <a href="./signup.php">Signup</a>
    </form>
</body>
</html>
