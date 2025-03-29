<?php
  session_start();
  require("../database/db_conn.php");

  include_once("./style.php");
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
<?php
    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Customer"){
            echo "<nav>
                    <span>
                        <h3>Quick Ride</h3>
                        <p>09218912891</p>
                        <button>Home</button>
                        <button>About</button>
                        <button>Contact</button>
                    </span>
                    <span>
                        <a href='../auth/logout.php'>logout</a>
                    </span>";
        }
    }else{
        echo "<nav>
                <span>
                    <h3>Quick Ride</h3>
                    <button>Home</button>
                    <button>About</button>
                    <button>Contact</button>
                </span>
                <span>
                    <a href='../auth/login.php'>Sign In</a>
                    <a href='../auth/signup.php'>Sign Up</a>
                </span>
            </nav>";

        echo "<div class='guestBG'></div>";
    }

    if(isset($_SESSION["email"])){
        if($_SESSION["role"] == "Admin"){
            include_once("./panels/admin.php");
        }else{
            include_once("./panels/customer.php");
        }
    }else{

    }
?>
</body>
</html>
