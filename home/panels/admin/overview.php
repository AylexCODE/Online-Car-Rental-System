<?php
    echo "<div class='overview'>
            <h4>Overview</h4>
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
                  <p id='oRentalsLabel'>Active Rentals</p>
                  <p id='oRentalsCount'>0</p>
                </span>
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
    }
    
    setOverviewInfo();
</script>
<style type="text/css">
    .overview {
        height: 100%;
    }

    .overview > span {
        height: 100%;
        padding: 0px 25px;
        overflow-y: scroll;
    }
    
    .overview > span:nth-child(2){
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
        height: fit-content;
    }
    
    .overview > span:nth-child(2) > span {
        display: grid;
        place-items: center;
        height: 100px;
        background-color: #316C40;
        border-radius: 10px;
        border-top: 5px solid #E2F87B;
    }
    
    .overview > span:nth-child(2) > span > span > p:nth-child(1){
        opacity: 0.8;
    }
    
    .overview > span:nth-child(2) > span > span > p:nth-child(2){
        font-size: 20px;
    }
    
    .overview > span:nth-child(2) > span > span {
        display: block;
        padding: 15px 20px;
        width: 20vw;
        height: fit-content;
        text-align: center;
    }
</style>