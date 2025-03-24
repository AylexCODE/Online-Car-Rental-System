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
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#" type="image/x-icon">
    <title>Car Rental System</title>
</head>
<body>
    <form action="./dashBoard.php">
        <h2>Login</h2>

        <p>Username</p>
        <input type="text" style="margin-bottom: 10px;" required>

        <p>Password</p>
        <input type="password" style="margin-bottom: 10px;" required>
        <button>Login</button>
    </form>
</body>
</html>
