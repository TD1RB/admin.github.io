<?php
require('components/header.php');
?>
    <style>
	#coin div {
    position: absolute;
  width: 100%;
  height: 100%;background: linear-gradient(45deg, white, white);
  -webkit-border-radius: 50%;
     -moz-border-radius: 50%;
          border-radius: 50%;
  
           -webkit-backface-visibility: hidden;
}


#coin {
  position: relative;
  margin: 0 auto;
  width: 200px;
  height: 200px;
  cursor: pointer;
 
  transition: -webkit-transform 1s ease-in;
  -webkit-transform-style: preserve-3d;
  border-radius:100%;
}

.side-a {
  z-index: 100;
}
.side-b {
  -webkit-transform: rotateY(-180deg);

}
#coin.rebro {
  -webkit-animation: flipRebro 6s ease-out forwards;
  -moz-animation: flipRebro 6s ease-out forwards;
    -o-animation: flipRebro 6s ease-out forwards;
       animation: flipRebro 6s ease-out forwards;
}
#coin.heads {
  -webkit-animation: flipHeads 6s ease-out forwards;
  -moz-animation: flipHeads 6s ease-out forwards;
    -o-animation: flipHeads 6s ease-out forwards;
       animation: flipHeads 6s ease-out forwards;
}
#coin.tails {
  -webkit-animation: flipTails 6s ease-out forwards;
  -moz-animation: flipTails 6s ease-out forwards;
    -o-animation: flipTails 6s ease-out forwards;
       animation: flipTails 6s ease-out forwards;
}

.side-a {
  z-index: 100;
}
.side-b {
  -webkit-transform: rotateY(-180deg);

}
.rebro {
	
	font-size: 40px;
	text-align: center;
	text-decoration: blink;
	color: red;
	z-index: 9999;
	
}

@media screen and (max-width: 557px) {

	.side-a {
 width: 150px;
  height: 150px;

}
.side-b {
 width: 150px;
  height: 150px;

}
	
}
@media screen and (min-width: 800px) {
#coin {
    margin-left:70px;
}


}
@media screen and (max-width: 300px) {

	.side-a {
  width: 100px;
  height: 100px;
}
.side-b {
  width: 100px;
  height: 100px;
}
	
}
@-webkit-keyframes flipHeads {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1800deg); -moz-transform: rotateY(1800deg); transform: rotateY(1800deg); }
}
@-webkit-keyframes flipTails {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1980deg); -moz-transform: rotateY(1980deg); transform: rotateY(1980deg); }
}
@-webkit-keyframes flipRebro {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(2970deg); -moz-transform: rotateY(2970deg); transform: rotateY(2970deg); }
}
</style>
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
               <div class="col" style="text-align:center;">
                              <div id="coin" class="" style="margin:0 auto;text-align:center;">

<div class="side-a"><img style="position: relative;height:100%;width:100%" src="img/hen1.svg"></div>
<div class="side-b"><img style="position: relative;height:100%;width:100%" src="img/egg1.svg"></div>  

                                        </div>
                           </div>
                           <div class="mt-3 col-lg-3">
                          
                           <div class="bets-tbl" id="betsss">
                               <div class="amount-bomb ">
                                    <div class="content">
                                      
                                    
                    
                    <div class="form-group">
                                      <label for="exampleInputEmail1">Сумма ставки</label>
                                      <input type="number" class="form-control" id="betSizeCoin" aria-describedby="emailHelp" value="1">
                                      <div class="btn-group d-flex"  role="group">
                    <button type="button" data-type="x2" onclick="var x = ($('#betSizeCoin').val()*2);$('#betSizeCoin').val(parseFloat(x.toFixed(2)));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#betSizeCoin').val(Math.max(($('#betSizeCoin').val()/2).toFixed(2), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#betSizeCoin').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#betSizeCoin').val($('#balance').attr('balance'));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                                      
                                    </div>
                                    
                                    
                      
                                 


  <div class="d-flex justify-content-center" style="position:relative;top:-10px;">
      <div class="coeff-item"><span class="coeff-text"><span id="caef">1.00</span>x</span><br><span class="coeff-text-x">Коэффициент</span></div>
      <div class="coeff-item"><span class="coeff-text"><span id="nextcaef">1.98</span>x</span><br><span class="coeff-text-x">След. коэфф</span></div>
  </div>
  
   <div class="">
   <div style="display:none;"id="coinButton" class="row row-sm" >
<div class="coinflipButtons  form-group col-6 col-md-6">
<button onclick="startGameCoinflip('1');" id="buttonMin" style="padding: 11px;" class="hen dice-game-box-percent-btn btn btn-theme btn-block">Курица</button>
</div>
<div class="coinflipButtons  form-group col-6 col-md-6">
<button onclick="startGameCoinflip('2');" id="buttonMax" style="padding: 11px;" class="egg dice-game-box-percent-btn btn btn-theme btn-block">Яйцо</button>
</div>
</div>

 <div  class="row row-sm" >
<div class="coinflipButtons  form-group col-12 col-md-12">
<button onclick="startcoin();" id="betCoin" style="padding: 11px;" class="dice-game-box-percent-btn btn btn-theme btn-block tx-thin btn-la-mob btn-sel-d">Сделать ставку</button>
</div>
<div class="coinflipButtons  form-group col-12 col-md-12">
<button onclick="finishcoin();" id="finishCoin" style="position:relative;top:-20px;display:none;padding: 11px;" class="dice-game-box-percent-btn btn btn-theme btn-block tx-thin btn-la-mob btn-sel-d">Забрать</button>
</div>
</div>
</div>
</div>
</div>
<style>
    .coeff-item {
	margin: 5px;
    width: 100%;
    height: 50px;
    border: 0.65px solid #777777;
    border-radius: 3px;
    display: inline-block;
    text-align: center;
    color: gray;
}
.carousel-control-prev-icon, .carousel-control-next-icon {
    filter: invert(1);
}
.coeff-text {
	padding:20px;
	box-sizing: border-box;
}
.coeff-text-x {
	margin-top:5px;
	font-weight: 300;
	font-size:11px;
}
</style>

                                  
                                </div>

<style>
#coin.rebro {
  -webkit-animation: flipRebro 3s ease-out forwards;
  -moz-animation: flipRebro 3s ease-out forwards;
    -o-animation: flipRebro 3s ease-out forwards;
       animation: flipRebro 3s ease-out forwards;
}
#coin.heads {
  -webkit-animation: flipHeads 3s ease-out forwards;
  -moz-animation: flipHeads 3s ease-out forwards;
    -o-animation: flipHeads 3s ease-out forwards;
       animation: flipHeads 3s ease-out forwards;
}
#coin.tails {
  -webkit-animation: flipTails 3s ease-out forwards;
  -moz-animation: flipTails 3s ease-out forwards;
    -o-animation: flipTails 3s ease-out forwards;
       animation: flipTails 3s ease-out forwards;
}

@-webkit-keyframes flipHeads {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1800deg); -moz-transform: rotateY(1800deg); transform: rotateY(1800deg); }
}
@-webkit-keyframes flipTails {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1980deg); -moz-transform: rotateY(1980deg); transform: rotateY(1980deg); }
}
@-webkit-keyframes flipRebro {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(2970deg); -moz-transform: rotateY(2970deg); transform: rotateY(2970deg); }
}</style>
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

    checkcoin();
    
    
    function finishcoin(){
       
$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
											
										
										},	
                                        data: {
                                        type: "finishcoin",
                                                                             
                                                                                  
                                                },
                                        success: function(data) {
                                             	var obj = data;
                                          
                                            if (obj.success == "success") {
	 $('.odometer').html(obj.new_balance);
    $('#balance').attr('balance', obj.new_balance);
			
			$('#betCoin').show();
			 $('#finishCoin').hide();   
 $('#coinButton').hide();   

	$('#caef').html(1.00);				
	$('#nextcaef').html(1.98);                                            }
                                        }
                                    });
        
    }
    function startGameCoinflip(typegame){
       window.update_history = 1;
        
$('.coinflipButtons > button').prop('disabled', true);
$('#coin').removeClass('tails');
$('#coin').removeClass('heads');
$('#coin').removeClass('rebro');



$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {


                    },
                                                                                data: {
                                                                                    type: "coinflip",
                                                                                    lay: typegame,
                                                                                   

                                                                                },
                                        success: function(data) {
	var obj = data;
                                           if(obj.success == "fatal") {
                $('.coinflipButtons > button').prop('disabled', false);
                                              // toastr["error"]("<b>Ошибка!</b><br>"+obj.error);
      return false;
                                           }
                                            if (obj.success == "success") {


                                                 if(obj.flipResult == 1){
                                                                                    $('#coin').addClass('heads');
                                                                                    }
                                                                                    if ( obj.flipResult == 2 ) {
                                                                                    $('#coin').addClass('tails');
                                                                                    }
                                                                                      if ( obj.flipResult == 30 ) {
                                                                                    $('#coin').addClass('rebro');
                                                                                    }
                                                                                    setTimeout(function(){
                                                                                        
                                                                                        
                                                                                        	$('#caef').html(obj.caef1.toFixed(2));				
                                                                    	$('#nextcaef').html(obj.nextcaef.toFixed(2));  
//toastr["success"](obj.message);
 window.update_history = 0;


}, 3000);
 
  setTimeout(function(){
    
   $('.coinflipButtons > button').prop('disabled', false);

                                                                                     }, 3000);

                                            }else{


         if(obj.flipResult == 1){
                                                                                    $('#coin').addClass('heads');
                                                                                    }
                                                                                    if ( obj.flipResult == 2 ) {
                                                                                    $('#coin').addClass('tails');
                                                                                    }
                                                                                      if ( obj.flipResult == 30 ) {
                                                                                    $('#coin').addClass('rebro');
                                                                                    }
                                                                                    setTimeout(function(){
//toastr["error"](obj.message);
     
                                                                                        	
                                                                                        	
			  $('#finishCoin').hide(); 
                                                                                        	$('#caef').html('1.00');				
                                                                    	$('#nextcaef').html('1.98');  
                                                                    	 $('#coinButton').hide();   
                                                                        window.update_history = 0;
			$('#betCoin').show();
			$('.coinflipButtons > button').prop('disabled', false);
}, 3000);


                                                                                   
                                      
                                      

                      } 
                      
                      
                      
                                        }
                                    });
    }
    
    
    function checkcoin(){
$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
											
										
										},	
                                        data: {
                                        type: "checkcoin",
                                                                             
                                                                                  
                                                },
                                        success: function(data) {
                                             	var obj = data;
                                          
                                            if (obj.success == "success") {

			$('#coinButton').show();
			$('#betCoin').hide();
			 $('#finishCoin').show();     
	$('#caef').html(obj.caef);	
		$('#betSizeCoin').val(obj.bet);
	$('#nextcaef').html(obj.nextcaef);                                            }
                                        }
                                    });
        
    }
        function startcoin() {
            $('#betCoin').hide();		
$.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
											
										
										},	
                                                                                data: {
                                                                                    type: "startcoin",
                                                                                    betsize: $('#betSizeCoin').val(),
                                                                                   
                                                                                    
                                                                                },
                                        success: function(data) {
	var obj = data;
                                          
                                           if(obj.success == "fatal") {
                $('#betCoin').html('Сделать ставку ');          
                 $('#betCoin').show();          
                                             
			
		//	toastr["error"](obj.error)
			return false;
                                           }
                                            if (obj.success == "success") {

			$('#coinButton').show();
		
			  $('#finishCoin').show();        
				setTimeout(function() {
				 $('.odometer').html(obj.new_balance);
    $('#balance').attr('balance', obj.new_balance);
				$('#betCoin').html('Сделать ставку');                                                       	
                $('#betCoin').prop('disabled', false);
				}, 200);
                	
                                            }
                                        }
                                    });
                                    
                                }
        </script>
<script>
		$(window).on('load', function () {
			 $('#balance').attr('balance', <?=$balance?>);
		  });
	</script>

</html>
