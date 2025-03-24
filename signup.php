<?php
    $conn = "";
    try{
        $conn = mysqli_connect("localhost", "root", "", "car_rental");
        //echo "Success";
    }catch(mysqli_sql_exception){
         echo "Error Tagak Pre!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        body {
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2px solid black;
            border-radius: 20px;
            padding: 50px;
        }

        p{
            align-self: start;
        }

        h2 {
            margin-bottom: 20px;
        }

        button {
            font-weight: 700;
            padding-block: 2px;
            padding-inline: 15px;
            margin-bottom: 10px;
        }

        a, a:visited{
            text-decoration: underline;
            color: black;
        }

        span {
            display: flex;
            flex-direction: row;
            font-size: 12px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#" type="image/x-icon">
    <title>Car Rental System</title>
</head>
<body>
    <form method="post">
        <h2>Signup</h2>

        <p>Username</p>
        <input type="text" style="margin-bottom: 10px;" required>

        <p>Password</p>
        <input type="password" style="margin-bottom: 10px;" required>
        <button type="submit" name="signup">Signup</button>
        <?php
            if(isset($_POST["signup"])){
                header("location: ./index.php?success");
            }
        ?>
        <span>
            <p>Already have an account?&nbsp;</p>
            <a href="./index.php">Click here</a>
        </span>
    </form>
</body>
</html>
