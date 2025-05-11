<?php
    // revenue, total rentals, peak rentals period
    echo "<div class='overview'>
            <h4>Overview</h4>
            <span>
              <span>
                <span>
                  <span class='oTtlBrands'>
                    <p id='oTotalBrandsLabel'>Total Brands</p>
                    <p id='oTotalBrandsCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oTtlModels'>
                    <p id='oTotalModelsLabel'>Total Models</p>
                    <p id='oTotalModelsCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oTtlCars'>
                    <p id='oTotalCarsLabel'>Total Cars</p>
                    <p id='oTotalCarsCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oCarMaintenance'>
                    <p id='oCarMaintenanceLabel'>Car Need Maintenance</p>
                    <p id='oCarMaintenanceCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='regUsers'>
                    <p id='oTotalUsersLabel'>Registered Users</p>
                    <p id='oTotalUsersCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oActiveVouchers'>
                    <p id='oVouchersLabel'>Active Vouchers</p>
                    <p id='oVouchersCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oActiveRentals'>
                    <p id='oActiveRentalsLabel'>Active Rentals</p>
                    <p id='oActiveRentalsCount'>0</p>
                  </span>
                </span>
                <span>
                  <span class='oAllRentals'>
                    <p id='oAllRentalsLabel'>Total Rentals</p>
                    <p id='oAllRentalsCount'>0</p>
                  </span>
                </span>
              </span>
              <span class='revenueWrapper'>
                <span class='revenueHeader'>
                  <p>Revenue</p>
                  <span class='revenueFilter'>
                    <p>Sort by:</p>
                    <select onchange='filterRevenue(this.value);'>
                      <option value='month'>Monthly</option>
                      <option value='date'>Daily</option>
                    </select>
                  </span>
                </span>
                <div>
                  <canvas id='revenueDisplay'></canvas>
                </div>
              </span>
              <span class='peakRentalsWrapper'>
                <span class='peakRentalsHeader'>
                  <p>Peak Rental Periods</p>
                  <span class='peakRentalsFilter'>
                    <p>Sort by:</p>
                    <select onchange='filterPeakRentals(this.value);'>
                      <option value='month'>Monthly</option>
                      <option value='date'>Daily</option>
                    </select>
                  </span>
                </span>
                <div>
                  <canvas id='peakRentalsDisplay'></canvas>
                </div>
              </span>
            </span>
        </div>";
?>
<script type="text/javascript">
    function setOverviewInfo(){
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getBrands',
            success: function(res){
                $("#oTotalBrandsCount").html(res);
                if(res > 1){
                    $("#oTotalBrandsLabel").html("Total Brands");
                }else{
                    $("#oTotalBrandsLabel").html("Total Brand");
                }
            },
            error: function(){}
        });
        
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getModels',
            success: function(res){
                $("#oTotalModelsCount").html(res);
                if(res > 1){
                    $("#oTotalModelsLabel").html("Total Models");
                }else{
                    $("#oTotalModelsLabel").html("Total Model");
                }
            },
            error: function(){}
        });
        
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getCars',
            success: function(res){
                $("#oTotalCarsCount").html(res);
                if(res > 1){
                    $("#oTotalCarsLabel").html("Total Cars");
                }else{
                    $("#oTotalCarsLabel").html("Total Car");
                }
            },
            error: function(){}
        });
        
        $.ajax({
            type: 'get',
            url: './queries/car/getCarInfo.php?name=maintenance',
            success: function(res){
                $("#oCarMaintenanceCount").html(res);
                if(res > 1){
                    $("#oCarMaintenanceLabel").html("Cars Need Maintenance");
                }else{
                    $("#oCarMaintenanceLabel").html("Car Need Maintenance");
                }
            }
        });
        
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getUsers',
            success: function(res){
                $("#oTotalUsersCount").html(res);
                if(res > 1){
                    $("#oTotalUsersLabel").html("Registered Users");
                }else{
                    $("#oTotalUsersLabel").html("Registered User");
                }
            },
            error: function(){}
        });
        
        $.ajax({
            type: 'get',
            url: './queries/rent/getVouchers.php?m=getCountActive',
            success: function(res){
                $("#oVouchersCount").html(res);
                if(res > 1){
                    $("#oVouchersLabel").html("Active Vouchers");
                }else{
                    $("#oVouchersLabel").html("Active Voucher");
                }
            },
            error: function(){
                
            }
        });
        
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getActiveRentals',
            success: function(res){
                $("#oActiveRentalsCount").html(res);
                if(res > 1){
                    $("#oActiveRentalsLabel").html("Active Rentals");
                }else{
                    $("#oActiveRentalsLabel").html("Active Rental");
                }
            },
            error: function(){
                
            }
        });
        
        $.ajax({
            type: 'get',
            url: './queries/overview/getInitialOverview.php?type=getTotalRentals',
            success: function(res){
                $("#oAllRentalsCount").html(res);
                if(res > 1){
                    $("#oAllRentalsLabel").html("Total Rentals");
                }else{
                    $("#oAllRentalsLabel").html("Total Rental");
                }
            },
            error: function(){
                
            }
        });
    }
    
    setOverviewInfo();
    
    function filterRevenue(filter){
        $.ajax({
            type: 'get',
            url: './queries/overview/getRevenue.php?type=payments&filter=' +filter,
            success: function(res){
              console.log(res)
              const amounts = res.split("|")[0];
              let amountsArray = amounts.split(" ").reverse();
              
              amountsArray.length = amountsArray.length-1;
              revenueChart.data.datasets[0].data = amountsArray;
              
              const dates = res.split("|")[1];
              let datesArray = dates.split("&nbsp;").reverse();
              if(filter == "month"){
                  for(let i = 0; i < datesArray.length; i++){
                      datesArray[i] = getMonthWord(datesArray[i]);
                  }
              }else{
                  for(let i = 0; i < datesArray.length; i++){
                      datesArray[i] = getMonthWord(datesArray[i].split(" ")[0]) +datesArray[i].substring(2, 11);
                  }
              }
              datesArray.length = datesArray.length-1;
              revenueChart.data.labels = datesArray;
              
              getRepairs(filter);
            },
            error: function(){}
        });
    }
    
    function getRepairs(filter){
        $.ajax({
            type: 'get',
            url: './queries/overview/getRevenue.php?type=repairs&filter=' +filter,
            success: function(res){
                const repairsCost = res.split("|")[0];
                const tempRepairsCostArray = repairsCost.split(" ");
                let repairsCostArray = [];
                
                const dates = res.split("|")[1];
                let datesArray = dates.split("&nbsp;");
                
                if(filter == "month"){
                    for(let i = 0; i < datesArray.length; i++){
                        datesArray[i] = getMonthWord(datesArray[i]);
                    }
                }else{
                    for(let i = 0; i < datesArray.length; i++){
                        datesArray[i] = getMonthWord(datesArray[i].split(" ")[0]) +datesArray[i].substring(2, 11);
                    }
                }
                
                const months = revenueChart.data.labels;
                for(let i = 0; i < datesArray.length; i++){
                    for(let j = 0; j < datesArray.length; j++){
                        if(months[i] == datesArray[j]){
                            repairsCostArray[i] = tempRepairsCostArray[j];
                        }
                    }
                }
                
                revenueChart.data.datasets[1].data = repairsCostArray;
                revenueChart.update();
            },
            error: function(){}
        });
    }
    
    function filterPeakRentals(filter){
        $.ajax({
            type: 'get',
            url: './queries/overview/getPeakRentalPeriods.php?filter=' +filter,
            success: function(res){
                const rentCount = res.split("|")[0];
                let rentCountArray = rentCount.split(" ").reverse();
                
                const rentDates = res.split("|")[1];
                let rentDatesArray = rentDates.split("&nbsp;").reverse();
            },
            error: function(){}
        });
    }
    
    function getMonthWord(month){
        switch(month){
            case '01':
            case '1':
                return "January";
            case '02':
            case '2':
                return "February";
            case '03':
            case '3':
                return "March";
            case '04':
            case '4':
                return "April";
            case '05':
            case '5':
                return "May";
            case '06':
            case '6':
                return "June";
            case '07':
            case '7':
                return "July";
            case '08':
            case '8':
                return "August";
            case '09':
            case '9':
                return "September";
            case '10':
                return "October";
            case '11':
                return "November";
            case '12':
                return "December";
            default: return '';
        }
    }
</script>
<script type="text/javascript">
    Chart.defaults.color = '#FDFFF6';
    
    const revenue = document.getElementById("revenueDisplay");
    
    const revenueChart = new Chart(revenue, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
              {
                label: "Revenue",
                data: [],
                borderColor: ['#E2F87B'],
                backgroundColor: ['#38814A80'],
                borderWidth: 1
              },
              {
                label: "Repair",
                data: [],
                borderColor: ['#b10303'],
                backgroundColor: ['#ff2323'],
                borderWidth: 1,
                categoryPercentage: 0.5
              }
            ]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        color: '#FFFFFF40'
                    },
                    stacked: true
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#FFFFFF40'
                    },
                    stacked: false
                }
            },
            indexAxis: 'x',
        }
    });
    filterRevenue("month");
</script>
<style type="text/css">
    .overview {
        height: 100%;
    }

    .overview > span {
        height: 100%;
        padding: 0px 25px;
        overflow-y: scroll;
        scroll-snap-type: y mandatory;
    }
    
    .overview > span:nth-child(2), .overview > span:nth-child(2) > span:nth-child(1) {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
        height: fit-content;
    }
    
    .overview > span:nth-child(2) > span:nth-child(1), .revenueWrapper, .peakRentalsWrapper {
        scroll-snap-align: start;
    }
    
    .overview > span:nth-child(2) > span:nth-child(1) > span {
        display: grid;
        place-items: center;
        height: 100px;
        background-color: #316C40;
        border-radius: 10px;
        border-top: 5px solid #E2F87B;
    }
    
    .overview > span:nth-child(2) > span:nth-child(1) > span > span > p:nth-child(1){
        opacity: 0.8;
    }
    
    .overview > span:nth-child(2) > span:nth-child(1) > span > span > p:nth-child(2){
        font-size: 20px;
    }
    
    .overview > span:nth-child(2) > span:nth-child(1) > span > span {
        display: block;
        padding: 15px 20px;
        width: 20vw;
        text-align: center;
    }
    
    .revenueWrapper, .peakRentalsWrapper {
        width: 98%;
        background-color: #316C40;
        border-radius: 10px;
        padding: 20px 30px;
    }
    
    .revenueWrapper > div, .peakRentalsWrapper > div {
        width: 98%;
    }
    
    .revenueHeader, .peakRentalsHeader {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    
    .revenueHeader > p, .peakRentalsHeader > p {
        font-size: 24px;
        font-weight: bold;
    }
    
    .revenueFilter, .peakRentalsFilter {
        color: #FDFFF6;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 5px;
    }
    
    .revenueFilter > p, .peakRentalsFilter > p {
        opacity: 0.8;
    }
    
    .revenueFilter > select, .peakRentalsFilter > select {
        color: #FDFFF6;
        border: none;
        outline: none;
        background-color: transparent;
        transform: translateY(1px);
    }
    
    .peakRentalsWrapper {
        margin-bottom: 15px;
    }
</style>