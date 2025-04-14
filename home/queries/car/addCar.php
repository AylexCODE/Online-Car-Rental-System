<?php
    if(isset($_POST["submitCar"])){
        $model = filter_input(INPUT_POST, "carModel", FILTER_SANITIZE_SPECIAL_CHARS);
        $brandID = filter_input(INPUT_POST, "carBrand", FILTER_SANITIZE_SPECIAL_CHARS);
        $transmission = filter_input(INPUT_POST, "carTransmission", FILTER_SANITIZE_SPECIAL_CHARS);
        $fuelType = filter_input(INPUT_POST, "carFuelType", FILTER_SANITIZE_SPECIAL_CHARS);
        $rentalPrice = filter_input(INPUT_POST, "rentalPriceDay", FILTER_SANITIZE_SPECIAL_CHARS);
        $availability = filter_input(INPUT_POST, "carAvailability", FILTER_SANITIZE_SPECIAL_CHARS);

        $rentalPrice = substr($rentalPrice, 3, strlen($rentalPrice));
        $file = $_FILES["file"]["name"];
        $ffile = $_FILES["file"]["tmp_name"];
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $fileNameExist = true;
        do{
            $query = "SELECT ImageName FROM cars WHERE ImageName = '$file';";

            try{
                $execQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($execQuery) == 0){
                    $fileNameExist = false;
                }else{
                    $file = substr($file, 0, strlen($file) - strlen($fileExtension) -1) . "A." . $fileExtension;
                }
            }catch(mysqli_sql_exception){
                echo "Error Database Pre";
            }
        }while($fileNameExist);

        $path = "./images/cars/" . $file;
        
        try{
            try{
                $query = "INSERT INTO models VALUES (null, '$brandID', '$model');";
                mysqli_query($conn, $query);
            }catch(mysqli_sql_exception){}

            $query = "SELECT ModelID FROM models WHERE BrandID = '$brandID'";
            $execQuery = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($execQuery);
            $modelID = $row["ModelID"];

            $query = "INSERT INTO cars VALUES (null, $brandID, '$modelID', '$fuelType', '$transmission', '$rentalPrice', $availability, '$file')";
            mysqli_query($conn, $query);
            if(move_uploaded_file($ffile, $path)){
                echo "<p class=\"msg\"><span class='" . "success" . "'>Vehicle Added</span></p>";
            }else{
                echo "<p class=\"msg\"><span class='" . "error" . "'>Error Pre</span></p>";
            }
        }catch(mysqli_sql_exception $e){
            echo "Error Database Pre";
            echo $e;
        }
    }
?>