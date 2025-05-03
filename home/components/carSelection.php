<?php
    echo "<section class='carsWrapper'>
        <span class='carFilter'>
            <span>
                <p>Filter by</p>
                <input list='transmissionFilter' id='tFilter' onfocus='this.value = &#x27;&#x27;' onblur='getCarsWFilter();' onchange='this.blur(); getCarsWFilter();' oninput='getCarsWFilter();' placeholder='Transmission'>
                <datalist id='transmissionFilter'>
                    <option value='Manual'>Manual</option>
                    <option value='Automatic'>Automatic</option>
                    <option value='Continuously Variable'>Continuously Variable</option>
                    <option value='Semi-Automatic'>Semi-Automatic</option>
                    <option value='Dual Clutch'>Dual Clutch</option>
                </datalist>
                <input list='brandsFilter' id='bFilter' onfocus='this.value = &#x27;&#x27;' onblur='getCarsWFilter();' onchange='this.blur(); getFilterModel(); getCarsWFilter();' oninput='getCarsWFilter();' placeholder='Brands'>
                <datalist id='brandsFilter'>
                    <option>Toyota</option>
                    <option>Ferrari</option>
                </datalist>
                <input list='fuelTypeFilter' id='fuelFilter' onfocus='this.value = &#x27;&#x27;' onblur='getCarsWFilter();' onchange='this.blur(); getCarsWFilter();' oninput='getCarsWFilter();' placeholder='Fuel Type'>
                <datalist id='fuelTypeFilter'>
                    <option value='Gasoline'>Gasoline</option>
                    <option value='Diesel'>Diesel</option>
                    <option value='Electric'>Electric</option>
                </datalist>
                <input list='modelFilter' id='mFilter' onfocus=this.value = &#x27;&#x27;' onblur='getCarsWFilter();' onchange='this.blur(); getCarsWFilter();' oninput='getCarsWFilter();' placeholder='Model'>
                <datalist id='modelFilter'>
                    <option>GTR 40</option>
                    <option>Supra MK4</option>
                </datalist>
                <button onclick='clearAllFilter();'>Clear All Filter</button>
            </span>
            <span>
                <span>
                    <p>Sort by</p>
                    <select id='fSort' onchange='getCarsWFilter();'>
                        <option value=''>Default</option>
                        <option value='Availability'>Availability</option>
                        <option value='RentalPrice'>Price</option>
                    </select>
                </span>
                <span>
                    <p>Order by</p>
                    <select id='fOrder' onchange='getCarsWFilter();' disabled>
                        <option value='ASC'>ASC</option>
                        <option value='DESC' id='fOrderDesc'>DESC</option>
                    </select>
                </span>
            </span>
        </span>";
?>

<script type="text/javascript">
    const tFilter = document.getElementById("tFilter");
    const bFilter = document.getElementById("bFilter");
    const fuelFilter = document.getElementById("fuelFilter");
    const mFilter = document.getElementById("mFilter");
    const fSort = document.getElementById("fSort");
    const fOrder = document.getElementById("fOrder");
    
    $.ajax({
        type: 'post',
        url: './queries/car/getCars.php',
        data: { type: 'getFilterBrand' },
        success: function(res) {
            $("#brandsFilter").html(res);
        },
        error: function() {
            $(".msg").html("Error Pre");
        }
    });
    
    function getFilterModel(){
        $.ajax({
            type: 'post',
            url: './queries/car/getCars.php',
            data: { type: 'getFilterModel', fromBrand: $("#bFilter").val() },
            success: function(res) {
                $("#modelFilter").html(res);
            },
            error: function() {
                $(".msg").html("Error Pre");
            }
        });
    }
    
    function getCarsWFilter(){
        if(fSort.value == "Availability"){
            //document.getElementById("fOrderDesc").selected = true;
            fOrder.disabled = false;
        }else if(fSort.value == ""){
            fOrder.disabled = true;
        }else{
            fOrder.disabled = false;
        }
        
        getCars(tFilter.value, bFilter.value, fuelFilter.value, mFilter.value, fSort.value, fOrder.value);
    }
    
    getFilterModel();
</script>