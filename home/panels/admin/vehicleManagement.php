<?php
    echo "<div class='vehicleManagement active'>
            <h4>Vehicle Management</h4>
            <span>
                <span>
                </span>
                <span>
                    <span>
                        <button popovertarget='addCars'>Add Vehicle</button>
                        <button>Add Brands</button>
                        <button>Add Location</button>
                    </span>
                    <span>";
    include_once("./components/cars.php");
    echo "</span>
                </span>
            </span>
            <div popover id='addCars'>
                <button popovertarget='addCars' popovertargetaction='hide' class='exitButton'>&#215;</button>
                <form method='post' enctype='multipart/form-data' class='addCarsForm'>
                    <span>
                        <span>
                            <input type='text' id='model' name='carModel' required>
                            <label for='model'>Model</label>
                        </span>
                        <span>
                            <select name='carBrand'>
                                <option value='1'>Toyota</option>
                                <option value='2'>Ferrari</option>
                                <option value='3'>Ford</option>
                            </select>
                            <label for='label'>Brand</label>
                        </span>
                    </span>

                    <input type='text' name='carTransmission' required>
                    <label>Transmission</label>

                    <input type='text' name='carFuelType' required>
                    <label>Fuel Type</label>

                    <input type='file' name='file'>
                    <button type='submit' name='submitCar'>Add Car</button>
                </form>
            </div>
        </div>";

    if(isset($_POST["submitCar"])){
        $model = filter_input(INPUT_POST, "carModel", FILTER_SANITIZE_SPECIAL_CHARS);
        $brand = filter_input(INPUT_POST, "carBrand", FILTER_SANITIZE_SPECIAL_CHARS);
        $transmission = filter_input(INPUT_POST, "carTransmission", FILTER_SANITIZE_SPECIAL_CHARS);
        $fuelType = filter_input(INPUT_POST, "carFuelType", FILTER_SANITIZE_SPECIAL_CHARS);

        $file = $_FILES["file"]["name"];
        $ffile = $_FILES["file"]["tmp_name"];
        $path = "./images/cars/" . $file;

        $query = "INSERT INTO cars VALUES (null, $brand, $model, $fuelType, $transmission, 999, 1, 0, $file)";

        if(move_uploaded_file($ffile, $path)){
            echo "Ok";
        }else{
            echo "Error pre";
        }
    }
?>