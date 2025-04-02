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
            <div popover id='addCars' name='addCars'>
                <span>
                    <span>
                        <input type='text'>
                        <label>Model</label>

                        <select>
                            <option>Toyota</option>
                            <option>Ferrari</option>
                            <option>Ford</option>
                        </select>
                    </span>

                    <input type='text'>
                    <input type='text'>
                </span>
            </div>
        </div>";
?>