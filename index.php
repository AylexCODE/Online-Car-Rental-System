<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }

        .loader {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background-color: #FFF;
            animation: 1.5s pulse infinite ease-in-out;
        }
        
        @keyframes pulse {
            0% {
            box-shadow: 0 0 0 0 #FFF;
            }
        
            100% {
            box-shadow: 0 0 0 14px #00000000;
            }
        }

        .loaderWrapper {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
            width: 100dvw;
            z-index: 999;
            background-color: #316C40;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Home/images/icon.png" type="image/x-icon">
    <meta http-equiv="refresh" content="2; url='./home/index.php'" />
    <title>Quick Ride</title>
</head>
<body>
    <div class="loaderWrapper">
        <div class="loader"></div>
    </div>
</body>
</html>
