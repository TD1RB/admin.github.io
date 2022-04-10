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
                                    	
		<div class="row ">
                <div class="col-xs-12 col-lg-6 mg-b-20">
                    <div class="pd-dc">
                      <div class="dice-m">
                        <h5 class="mg-b-0 d-flex justify-content-center d-md-none" style="color: #0168fa;text-shadow: 0 0 35px #0168fa;font-size: 50px;" id="diceResultMobile">1.25</h5>
                        <p class="tx-13  tx-semibold tx-spacing-0 tx-color-03 d-flex justify-content-center tx-thin d-md-none">Возможный выигрыш</p>
                        </div>
                        <div class="row row-sm mg-t-10 ">
                            <div class="col-lg-6 mb-3 col-xs-6 ">
                                <h6 class="mg-b-15 h-mob-d">Cумма:</h6>
                                <div class="dice-input">
                                    <input value="1" id="diceGameAmount" autocomplete="off" onkeyup="validatediceGameAmountD(this);updateProfit()" class="dice-input tx-20 tx-center form-control tx-normal tx-rubik" placeholder="Сумма">
                                    <div class="btn-group d-flex "  role="group">
                    <button type="button" data-type="x2" onclick="var x = ($('#diceGameAmount').val()*2);$('#diceGameAmount').val(parseFloat(x.toFixed(2)));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#diceGameAmount').val(Math.max(($('#diceGameAmount').val()/2).toFixed(2), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#diceGameAmount').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#diceGameAmount').val($('#balance').attr('mybalance'));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                                </div>
                                


                            </div>
                            <div class="col-lg-6 mb-3 col-xs-6 ">
                                <h6 class="mg-b-15 h-mob-d">Шанс:</h6>
                                <div class="dice-input">
                                    <input value="80" id="diceGamePercent" autocomplete="off" onkeyup="validatediceGamePercentD(this);updateProfit()" class="form-control" placeholder="Шанс">
                                    <div class="btn-group d-flex "  role="group">
                    <button type="button" data-type="x2" onclick="$('#diceGamePercent').val(Math.min(($('#diceGamePercent').val()*2).toFixed(2), 95));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#diceGamePercent').val(Math.max(($('#diceGamePercent').val()/2).toFixed(2).replace(/.00/g, ''), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#diceGamePercent').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#diceGamePercent').val(90);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                                </div>
                                


                            </div>
                        </div>
                        <div class="divider-text hash-mob mg-t-20 mt-3 d-none d-sm-block " style="text-align: center;">Hash игры</div>
                        <div class="col-md-12  tx-xs-center tx-color-03 tx-thin d-none d-sm-block  hash-mob" style="word-wrap: break-word;text-align: center;" id="hashBet">
                            64e5fc4c37f6f4832bb67c485197fc27f907925091fe9b06f8b02576fb6bc697b3d5f520f5054e0b6f30b6605b331fbb5bc466ac27a3e8417031a410ece6b22a                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="col-lg-12 but-dice">
                        <h5 class="tx-normal tx-rubik  justify-content-center d-none d-sm-flex" style="color: #0168fa;text-shadow: 0 0 35px #0168fa;font-size: 50px;" id="diceResult">1.25</h5>
                        <p class="tx-13  tx-semibold tx-spacing-0 tx-color-03 justify-content-center tx-thin d-none d-sm-flex" style="pointer-events: none">Возможный выигрыш</p>
                        <div class="row row-sm">
                            <div class="form-group col-6 col-md-6">
                                <p class="tx-color-03 tx-thin d-flex justify-content-center  h-mob-d" style="pointer-events: none;margin-bottom: 0px;font-size: 13px;">0 -&nbsp;<span id="MinRange" class="pd-l-3">799999</span></p>
                                <button onclick="betMin()" id="buttonMin" style="margin-top: 0px;padding: 11px;" class="btn btn-theme btn-block tx-thin btn-la-mob btn-sel-d">Меньше</button>
                            </div>
                            <div class="form-group col-6 col-md-6 ">
                                <p class="tx-color-03 tx-thin d-flex justify-content-center  h-mob-d" style="pointer-events: none;margin-bottom: 0px;font-size: 13px;"><span id="MaxRange" class="pd-r-3">200000</span>&nbsp;- 999999</p>
                                <button onclick="betMax()" id="buttonMax" style="margin-top: 0px;padding: 11px;" class="btn btn-theme btn-block tx-thin btn-la-mob btn-sel-d">Больше</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-md-12 but-dice ht-30" style="margin-top: 0px;">
<center></center>
                        <button id="succes_bet" style="  padding: 11px;pointer-events: none;margin-top: 0px;display:none;" class="btn btn-block tx-medium btn-la-mob bg-success tx-white bd-0 btn-sel-d "></button>
                        <button id="error_bet" style="padding: 11px; pointer-events:none; display:none; margin-top:0" class="btn btn-block tx-medium btn-la-mob bg-danger tx-white bd-0 btn-sel-d "></button>
                        <span id="checkBet" class="align-items-center link-03 justify-content-center mg-t-5" href="#checkModal" data-toggle="modal" style="display:none; cursor:pointer">Проверить игру</span>
                 
                    </div>
                </div>
            </div>
         
         	 
         	 <script>

 function betMin() {
                                    var nwin = $('#MinRange').html();
                                    var win = ((100 / $('#diceGamePercent').val()) * $('#diceGameAmount').val()).toFixed(2);
                                    var sum = $('#diceGameAmount').val();
                                    var coef = win - sum;
$.ajax({
                                                                                type: 'POST',
                                                                                url: 'action.php',
beforeSend: function() {

					$('#betLoad').css('display', '');
  $('#error_bet').hide();
   $('#succes_bet').hide();
			 $('#dice_check').hide();
						},	
                                                                                data: {
                                                                                    type: "minbet",
                                                                                  win: coef,
                                                                                  sum: sum,
                                                                                   nwin: nwin,
                                                                                  per: $('#diceGamePercent').val()
                                                                                   
                                                                                    
                                                                                },
                                        success: function(data) {
                                          $('#betLoad').css('display', 'none');
                                            var obj = data;
                                            
                                            if (obj.success == "success") {
                                               
                                               if (obj.random != ""){
                                             			 $('#dice_check').show();
                                             			  $('#dice_random').val(obj.random);
                                             			   $('#dice_sign').val(obj.sign);
                                             		}	
	$('#error_bet').hide();
   $('#succes_bet').show();
				$('#succes_bet').html('Выиграли <b>' +obj.fullwin+ '</b>');
				$('#succes_bet').html(obj.error);
                                              


$('#balance').html(obj.new_balance);
$('#mobbalance').html(obj.new_balance);
 $('#balance').attr('balance', obj.new_balance);	
                                                                      
                                              $('#hashBet').fadeOut('slow', function() {
                                                                            $('#hashBet').fadeIn('slow', function() {

                                                                            });
                                                                        });
$('#hashBet').html(obj.hash); 
                                                                return 
                                            }else{
                                            	
                                            	if (obj.random != ""){
                                             			 $('#dice_check').show();
                                             			 $('#dice_random').val(obj.random);
                                             			   $('#dice_sign').val(obj.sign);
                                             		}	
                                              $('#balance').attr('balance', obj.new_balance);
                                              $('#mobbalance').html(obj.new_balance);
                                              $('#balance').html(obj.new_balance);

 	$('#error_bet').show();
   $('#succes_bet').hide();				
$('#error_bet').html(obj.error);
                                            
$('#hashBet').fadeOut('slow', function() {
                                                                            $('#hashBet').fadeIn('slow', function() {

                                                                            });
                                                                        });
$('#hashBet').html(obj.hash); 
    return $('#error_bet').css('display', '');
												
											}
                                        }
                                    });
                                                          
}
                                                     
                                  function betMax() {
                                    var nwin = $('#MaxRange').html();
                                    var win = ((100 / $('#diceGamePercent').val()) * $('#diceGameAmount').val()).toFixed(2);
                                    var sum = $('#diceGameAmount').val();
                                    var coef = win - sum;
$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
		 $('#dice_check').hide();
								
$('#betLoad').css('display', '');
  $('#error_bet').hide();
   $('#succes_bet').hide();						},	
                                                                                data: {
                                                                                    type: "maxbet",
                                                                                    win: coef,
                                                                                    sum: sum,
                                                                                    nwin: nwin,
                                                                                    per: $('#diceGamePercent').val()
                                                                                  
                                                                                   
                                                                                    
                                                                                },
                                        success: function(data) {
                                          $('#betLoad').css('display', 'none');
                                            var obj = data;
                                            
                                            if (obj.success == "success") {
                                               if (obj.random != ""){
                                             			 $('#dice_check').show();
                                             			  $('#dice_random').val(obj.random);
                                             			   $('#dice_sign').val(obj.sign);
                                             		}	

  $('#balance').attr('balance', obj.new_balance);
                                              $('#mobbalance').html(obj.new_balance);
                                              $('#balance').html(obj.new_balance);

$('#error_bet').hide();
   $('#succes_bet').show();
		
   $('#succes_bet').html('Выиграли <b>' +obj.fullwin+ '</b>');
                               	$('#succes_bet').html(obj.error);
                                              $('#hashBet').fadeOut('slow', function() {

                                                                            $('#hashBet').fadeIn('slow', function() {


                                                                            });
                                                                        });
$('#hashBet').html(obj.hash); 
                                                                return $('#succes_bet').css('display', '');
                                            }else{
                                            	
                                            	 if (obj.random != ""){
                                             			 $('#dice_check').show();
                                             			  $('#dice_random').val(obj.random);
                                             			   $('#dice_sign').val(obj.sign);
                                             		}	
                                                $('#balance').attr('balance', obj.new_balance);
                                              $('#mobbalance').html(obj.new_balance);
                                              $('#balance').html(obj.new_balance);

	$('#error_bet').show();
   $('#succes_bet').hide();
   $('#error_bet').html(obj.error);		
$('#error_bet').html(obj.error);
  $('#hashBet').fadeOut('slow', function() {
          $('#hashBet').fadeIn('slow', function() {
						  });
                                });
$('#hashBet').html(obj.hash);                                                               

												
											}
                                        }
                                    });
}                                                        


                                                        function updateProfit() {
                                                        	
                                                                        $('#diceResultMobile').html(((100 / $('#diceGamePercent').val()) * $('#diceGameAmount').val()).toFixed(2));
                                                                        $('#diceResult').html(((100 / $('#diceGamePercent').val()) * $('#diceGameAmount').val()).toFixed(2));
                                                                        $('#MinRange').html(Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                                        $('#MaxRange').html(999999 - Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                             
                                                        	
                                                        }

                                                                    function sss() {
                                                                        $('#hashBet').fadeOut('slow', function() {
                                                                            $('#hashBet').fadeIn('slow', function() {

                                                                            });
                                                                        });
                                                                    }
                                                                    $('#diceGamePercent').keyup(function() {
                                                                        $('#MinRange').html(Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                                        $('#MaxRange').html(999999 - Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                                    });
                                                                    $('#diceGameAmount').keyup(function() {
                                                                        $('#MinRange').html(Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                                        $('#MaxRange').html(999999 - Math.floor(($('#diceGamePercent').val() / 100) * 999999));
                                                                           });
                                                        
                                                   
                                                                </script>
                                            <script>
                                                function validatediceGamePercentD(inp) {
                                                    if (inp.value > 90) {
                                                        inp.value = 90;
                                                    }


                                                    inp.value = inp.value.replace(/[,]/g, '.')
                                                        .replace(/[^\d,.]*/g, '')
                                                        .replace(/([,.])[,.]+/g, '$1')
                                                        .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
                                                }

                                            </script>
                                            <script>
                                                function validatediceGameAmountD(inp) {

                                                    inp.value = inp.value.replace(/[,]/g, '.')
                                                        .replace(/[^\d,.]*/g, '')
                                                        .replace(/([,.])[,.]+/g, '$1')
                                                        .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
                                                }

                                            </script>
                                    
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
