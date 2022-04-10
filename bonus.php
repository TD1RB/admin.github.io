<!DOCTYPE html>
<?php
require('components/header.php');
?>
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb bc-colored bg-theme" id="breadcrumb">

            </ol>
            <div class="container-fluid">

                <div class="animated fadeIn">

                    
                    <!-- end row -->
                    <div class="row">
                        <div class="col-md-12">
                            
                                 <div class="card card-accent-theme">
                                   <div class="card-body">
                                    <div class="row">
                                    	<div class="col-lg-5">
                                    		<div>
                                    		<h5 class="text-theme">Промокод</h5>
                                    		<form action="#" method="post" class="form-horizontal">
                                       
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" id="promocode" name="input2-group2" class="form-control" placeholder="Активировать">
                                                    <span class="input-group-btn">
                                                        <button type="button" onclick="activeprom()"class="btn btn-theme">Активировать</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                <div class="input-group">
                                                    <div style="transform: scale(0.65);" class="g-recaptcha" data-sitekey="<?=$sitekey?>"></div>
                                                </div>
                                            </div>
                                    </form>
                                    		</div>
                                    		
                                    		
                                    		
                                    		
                                    	</div>
                                    	<div class="col-lg"></div>
                                    	<div class="col-lg-5">
                                    		
                                    		
                                    		<div>
                                    		<h5 class="text-theme">Ежедневный Бонус</h5>
                                    	<form action="#" method="post" class="form-horizontal">
                                       
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-btn w-100 ">
                                                        <button type="button" onclick="getBonus()"class="btn btn-theme w-100 ">Получить</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                                <div class="input-group">
                                                    <div style="transform: scale(0.65);" class="g-recaptcha" data-sitekey="<?=$sitekey?>"></div>
                                                </div>
                                            </div>
                                    </form>
                                    		</div>
                                    		
                                    	</div>
                                    </div>

                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                        
<script>
	      function getBonus() {
	      	if ($('#g-recaptcha-response-1').val() == '') {
                                    return toastr["error"]('Поставьте галочку') 
                                }
    $.ajax({
       type: 'POST',
       url: '../action.php',
beforeSend: function() {    },  

    data: {
    type: "daily"
    
                                                                             
     },
         success: function(data) {
     var obj = data;
     if(obj.fa != 'success') {
     	toastr["error"](obj.error)
       	
      
        return false;
     }
     if(obj.fa == 'success') {
     	toastr["success"](obj.gift)
    $('#balance').html(obj.newbalance);
  
     }
     
    }
  }); 
}


 

function activeprom() {
	if ($('#g-recaptcha-response').val() == '') {
                                    return toastr["error"]('Поставьте галочку') 
                                }
	
    $.ajax({
       type: 'POST',
       url: '../action.php',
beforeSend: function() {    },  

    data: {
    type: "activePromo",
    promoactive: $('#promocode').val()                                                                         
     },
         success: function(data) {
     var obj = data;
     if(obj.fa != 'success') {
     	
     	toastr["error"](obj.error)
       	
        return false;
     }
     if(obj.fa == 'success') {
     		toastr["success"]('Промокод активирован на сумму '+obj.sum+'р!')
     	
    $('#balance').html(obj.new_balance);
  
     }
     
    }
  }); 
}


</script>




                    <!-- end row -->
                </div>
                <!-- end animated fadeIn -->
            </div>
            <!-- end container-fluid -->
        </main>
        <!-- end main -->




    </div>
    <!-- end app-body -->


    <!-- Bootstrap and necessary plugins -->
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/bootstrap/bootstrap.min.js"></script>
    <script src="libs/PACE/pace.min.js"></script>
    <script src="libs/chart.js/dist/Chart.min.js"></script>
    <script src="libs/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="libs/jquery-knob/dist/jquery.knob.min.js"></script>

    <!--morris js -->
    <script src="libs/raphael/raphael.min.js"></script>
    <script src="libs/charts-morris-chart/morris.min.js"></script>
    <script src="libs/tables-datatables/dist/datatables.min.js"></script>
<script src="libs/toastr/toastr.min.js"></script>
<script src="js/toastr-example.js"></script>

    <!-- jquery-loading -->
    <script src="libs/jquery-loading/dist/jquery.loading.min.js"></script>
    <!-- octadmin Main Script -->
    <script src="js/app.js"></script>


        <!-- datatable examples -->
        <script src="js/table-datatable-example.js"></script>
    <!-- dashboard-ecom script -->
    <script src="js/dashboard-ecom-widgets.js"></script>
    <script src="https://gamewin.space/js/odometer.js"></script>

</body>

</html>
