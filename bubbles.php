<?php
require('components/header.php');
?>
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb bc-colored bg-theme" id="breadcrumb">


            </ol>


            <div class="container-fluid">

                <div class="animated fadeIn">

                    <div class="row">
                        <div class="col-md">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">

	<div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-12 border-right-blue-grey border-right-lighten-5 border-left-blue-grey border-left-lighten-5">
                        <div class="p-1">
                         
                           <div class="card-body" style="margin-top:2px;">
                              <div id="controlBet" class="row">
                                 <div class="col-md-6 dice-mob">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Сумма ставки: </label>
                                       <input id="BetSize" onkeyup="validateBetSize(this); updateProfit();" value="1" class="form-control text-xs-center" autocomplete="off">


                                       <div class="btn-group d-flex"  role="group">
                    <button type="button" data-type="x2" onclick="var x = ($('#BetSize').val()*2);$('#BetSize').val(parseFloat(x.toFixed(2)));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#BetSize').val(Math.max(($('#BetSize').val()/2).toFixed(2), 0.01));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#BetSize').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#BetSize').val($('#balance').attr('balance'));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                           


                                      
                                       <script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/releases/UFwvoDBMjc8LiYc1DKXiAomK/recaptcha__ru.js" crossorigin="anonymous" integrity="sha384-5ytfQ6nJGZI32BNaF94kSKKsFBLlsKZHx9+561GKHVgUmaqaee3FA3dmdWzk4aEL"></script><script>
                                        function updateProfit() {
                                              $('#MinRange').html(Math.floor(($('#BetPercent').val() / 100) * 999999));
    $('#MaxRange').html(999999 - Math.floor(($('#BetPercent').val() / 100) * 999999));
    $('#BetX').html((100 / $('#BetPercent').val()).toFixed(2));
  $('#upgradeCef').html((($('#upgradeWin').val() / $('#BetSizeUpgrade').val())).toFixed(2));
  $('#upgradeChance').html(((100 / $('#upgradeCef').html())).toFixed(2));
    $('#BetProfit').html(($('#BetPercent').val() * $('#BetSize').val()).toFixed(2));
                                        }
                                          function validateBetSize(inp) {
                                          
                                              inp.value = inp.value.replace(/[,]/g, '.')
                                                  .replace(/[^\d,.]*/g, '')
                                                  .replace(/([,.])[,.]+/g, '$1')
                                                  .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
                                          }
                                       </script>
                                       <style type="text/css">
.btn-white {
    color: #5e676f;
    background-color: #fff;
    border-color: #8E8E8E;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
}
input {
  text-align: center;
}
</style>
                                    </div>
                                 </div>
                                 <div class="col-md-6 dice-mob">
                                    <div class="form-group">
                                       <label >Коэффицент:</label>
                                       <input id="BetPercent" onkeyup="validateBetPercent(this);updateProfit()" class="form-control text-xs-center" value="2"  autocomplete="off">

                                        <div class="btn-group d-flex"  role="group">
                    <button type="button" data-type="x2" onclick="$('#BetPercent').val(Math.min(($('#BetPercent').val()*2).toFixed(2), 100000));updateProfit()"  data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#BetPercent').val(Math.max(($('#BetPercent').val()/2).toFixed(2).replace(/.00/g, ''), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#BetPercent').val(2);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#BetPercent').val(10000);updateProfit()"data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>


                                      
                                       <script>
                                          function validateBetPercent(inp) {
                                              if (inp.value > 10000) {
                                                  inp.value = 10000;
                                              }
                                          
                                          
                                              inp.value = inp.value.replace(/[,]/g, '.')
                                                  .replace(/[^\d,.]*/g, '')
                                                  .replace(/([,.])[,.]+/g, '$1')
                                                  .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
                                          }
                                       </script>
                                    </div>
                                 </div>
                              </div>
                              <center>
                                 <div class="hidden-xs-down">
                                    <div class="card-subtitle line-on-side text-muted text-xs-center font-small-3 mx-1 my-1 ">
                                       <hr>
                                       <span>Hash игры</span>
                                    </div>
                                    <center style="word-wrap:break-word;padding-bottom:5px">
                                       <b id="hashBet" hid="12" style="">d2db4e34c6c74f9ee33ad34ecf3b3356825e4d7d73a6f608002eb7825233a484422834bf05786b9265f82a3dc17f3bc74bbaf1a68764c445df180ada3af9849b</b>                                   
                                       <div id="loader_hash" style="position:relative;display:none">
                                          <div id="dot-container_hash">
                                             <div id="left-dot_hash" class="black-dot"></div>
                                             <div id="middle-dot_hash" class="black-dot"></div>
                                             <div id="right-dot_hash" class="black-dot"></div>
                                          </div>
                                       </div>
                                    </center>
                                    <center>
                                       
                                    </center>
                                 </div>
                              </center>
                           </div>
                        </div>
                     </div>
                     <div id="betStart" class="col-lg-6 col-md-6 col-sm-12 ">
                        <div class="p-1 text-xs-center" style="margin-top:16px;text-align: center;">
                           <div>
                              <h3 class="display-4" style="color:#1288ff;word-wrap:break-word;font-size:2.7rem!important;font-weight: 600;"><span id="BetProfit" style="word-wrap:break-word;font-size:2.9rem!important;font-weight: 600;" class="display-4 success1">2.00</span> <i class="fas fa-coins" style=""></i></h3>
                           </div>
                           <span class="text-muted" style="color:#1288ff;font-size:17px">Возможный выигрыш</span>
                           <div>
                              <h3 class="display-4" style="color:#1288ff;word-wrap:break-word;font-size:2.7rem!important;font-weight: 600;"><span id="BetX" style="word-wrap:break-word;font-size:2.9rem!important;font-weight: 600;" class="display-4 success1 ">50.00</span><span style="">%</span></h3>
                           </div>
                           <span class="text-muted" style="color:#1288ff;font-size:17px">Шанс выигрыша</span>
                           <div class="card-body">
                              <div class="row text-xs-center" style="padding-top:10px">
                                 <div class="col-md-12 dice-mob">
                                    <div class="form-group">
                                    
                                       <button class="btn w-sm mb-1 btn-theme" onclick="bubble()" style="padding:10px;width: 100%;display: block;">Сделать ставку</button>

                                        <a id="succes_bet" class="btn red btn-raised btnError" style="color: #fff;background: linear-gradient(to right, rgb(10, 203, 144), rgb(43, 222, 109)); pointer-events: none; box-shadow: rgba(0, 215, 126, 0.27) 0px 5px 23px 0px;width:100%!important;display: none;">Выпало 25540</a>
                              <a id="error_bet" class="btn green btn-raised btnSuccess" style="color: #fff;background: linear-gradient(to left, #ff7777, #ff5b6f)!important;width:100%!important;pointer-events: none; box-shadow: rgba(255, 105, 114, 0.14) 0px 5px 23px 0px; display: none;"><b>Выиграли 777 <i class="fas fa-coins"></i></b></a>
                                    </div>
                                 </div>
                                                              
                              </div>
                              <center>
                                 <div id="betLoad" class="cssload-loader" style="background: none; display: none;">
                                    <div class="cssload-inner cssload-one"></div>
                                    <div class="cssload-inner cssload-two"></div>
                                    <div class="cssload-inner cssload-three"></div>
                                 </div>
                              </center>
<script type="text/javascript">
  

function bubble() {

$.ajax({
    type: 'POST',
    url: 'action.php',
beforeSend: function() {
  $('#betLoad').css('display', '');
  $('#error_bet').css('display', 'none');
  $('#succes_bet').css('display', 'none');
},  
    data: {
    type: 'bubble',
    per: $('#BetPercent').val(),
    sum: $('#BetSize').val(),                                                                               
                                                                                    
},
   success: function(data) {
$('#betLoad').css('display', 'none');
var obj = (data);

if (obj.success == "success") {
$('.mob-balance').attr('mybalance', obj.new_balance);
 $('.odometer').html(obj.new_balance);
  $('.mob-balance').html(obj.new_balance+' Р');
$('#error_bet').css('display', 'none');                
$('#succes_bet').show(); 
$('#succes_bet').html('Победа! Коэф <b>' +obj.number+ 'х</b>');
if(obj.hashEdit == 'yes') {
$('#hashBet').fadeOut('slow', function() {
$('#hashBet').fadeIn('slow', function() {

});
});
$('#hashBet').html(obj.hash); 
} else {
  // nothing
}                                                      
}else{

$('#error_bet').html(obj.error);
 $('#succes_bet').css('display', 'none');
if(obj.hashEdit == 'yes') {
$('#hashBet').fadeOut('slow', function() {
$('#hashBet').fadeIn('slow', function() {

});
});
$('#hashBet').html(obj.hash); 
} else {
  // nothing
}  
$('.mob-balance').attr('mybalance', obj.new_balance);
 $('.odometer').html(obj.new_balance);
  $('.mob-balance').html(obj.new_balance+' Р');
return $('#error_bet').css('display', '');
                        
}
}
});
                                                          
}
</script>
                           </div>

                           <br>
                           <br>
                           <br>
                        </div>
                     </div>
                  </div>
       
         	 
                                    
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end ecom-widget-sales -->
                        </div>

                        <!-- end col -->
                       
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                     <? require('components/history.php'); ?>
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


    <!-- jquery-loading -->
    <script src="libs/jquery-loading/dist/jquery.loading.min.js"></script>
    <!-- octadmin Main Script -->
    <script src="js/app.js"></script>


        <!-- datatable examples -->
        <script src="js/table-datatable-example.js"></script>
    <!-- dashboard-ecom script -->
    <script src="js/dashboard-ecom-widgets.js"></script>
    <script src="libs/toastr/toastr.min.js"></script>
<script src="js/toastr-example.js"></script>
 <script src="https://gamewin.space/js/odometer.js"></script>


</body>

<script>
		$(window).on('load', function () {
			 $('#balance').attr('balance', <?=$balance?>);
		  });
	</script>

</html>
