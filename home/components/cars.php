<?php
    echo "<p class='carsFound' style='margin: 10px 0px 5px 10px;'><span id='carManageFound'></span> Found</p>";
    echo "<span class='scrollCars'>";
        // Image Dimensions height: 180px | width: 277.5px;
    echo "</span>";
?>

<script type="text/javascript">
    function updateCarsFound(carsFound){
        const countDisplay = document.getElementById("carManageFound");
      
        let count = 0;
        function countUp(){
            countDisplay.innerHTML = count > 1 ? count +" Cars" : count +" Car";
            
            if(count != carsFound){
                count++;
                
                setTimeout(countUp, (count/carsFound)*100);
            }
        }
        countUp();
    }
    
    const observeChanges = new MutationObserver(() => {
        let carsFound = document.querySelector(".scrollCars").children.length;
        updateCarsFound(carsFound);
    });
    
    observeChanges.observe(document.querySelector(".scrollCars"), {
        childList: true
    });
</script>