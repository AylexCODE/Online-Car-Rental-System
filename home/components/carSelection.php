<?php
    echo "<section class='carsWrapper'>
        <span class='carFilter'>
            <span>
                <p>Filter by</p>
                <input list='transmissionFilter' id='tFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Transmission'>
                <datalist id='transmissionFilter'>
                    <option>Manual</option>
                    <option>Auto</option>
                </datalist>
                <input list='brandsFilter' id='bFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Brands'>
                <datalist id='brandsFilter'>
                    <option>Toyota</option>
                    <option>Ferrari</option>
                </datalist>
                <input list='fuelTypeFilter' id='fuelFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Fuel Type'>
                <datalist id='fuelTypeFilter'>
                    <option>Petrolium</option>
                    <option>Diesel</option>
                </datalist>
                <input list='modelFilter' id='mFilter' onfocus='this.value = &#x27;&#x27;' onchange='this.blur();' placeholder='Model'>
                <datalist id='modelFilter'>
                    <option>GTR 40</option>
                    <option>Supra MK4</option>
                </datalist>
                <button onclick='clearAllFilter()'>Clear All Filter</button>
            </span>
            <span>
                <p>Sort by</p>
                <select>
                    <option>Alphabet</option>
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </span>
        </span>";
?>