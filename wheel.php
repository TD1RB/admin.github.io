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
                        <div class="col-md-3">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">
                                  <style>
										.btn.bet {

										width: 20% !important; 
										margin: 4px;  

										}
										 

								</style>
						<form>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Сумма ставки</label>
                                      <input type="number" class="form-control" value="1" id="betwheel" aria-describedby="emailHelp">
                                       <div class="btn-group d-flex"  role="group">
                    <button type="button" data-type="x2" onclick="var x = ($('#betwheel').val()*2);$('#betwheel').val(parseFloat(x.toFixed(2)));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#betwheel').val(Math.max(($('#betwheel').val()/2).toFixed(2), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#betwheel').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#betwheel').val($('#balance').attr('balance'));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                                    </div>
                                    
                                  </form>


                                <div class="">
                                    <div class="input-item input-with-label">
                                         <div style="font-weight: 600;margin: 0 auto;text-align: center;">Уровень</div>
                                        <div class="selected  text-center">
                                            <label style="width: 100% !important;" class="selectWheels  btn bet active" data-mode="easy" onclick=""><span>Лёгкий</span></label>
                                            <label style="width: 100% !important;" class="selectWheels btn bet" data-mode="medium" onclick="system.wheel.select(2)"><span>Средний</span></label>
                                            <label style="width: 100% !important;" class="selectWheels btn bet" data-mode="hard" onclick="system.wheel.select(3)"><span>Сложный</span></label>
                                        </div>
                                    </div>
                                    
                                </div>
								<br>
                                <div class="">
                                    <span class="error" style="display: none"></span>
                                    <div id="BetWheel" class="input-item input-with-label"><a onclick="playWheel()" style="color:#fff" class="btn-deposit btn btn-theme btn-block">Играть</a></div>
                                </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end ecom-widget-sales -->
                        </div>
                        <style>
                        	.legend-wheel {
    display: -webkit-inline-box;
    display: inline-flex;
    position: relative;
    vertical-align: middle;
    height: 418px;
    width: 418px
}

.legend-wheel-circle {
    display: inherit;
    position: inherit;
    vertical-align: inherit;
    height: inherit;
    width: inherit
}

.legend-wheel-img {
    height: 100%;
    width: auto;
    z-index: 1;
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: -webkit-transform 4.5s cubic-bezier(.46,.07,.04,.98);
    transition: -webkit-transform 4.5s cubic-bezier(.46,.07,.04,.98);
    transition: transform 4.5s cubic-bezier(.46,.07,.04,.98);
    transition: transform 4.5s cubic-bezier(.46,.07,.04,.98),-webkit-transform 4.5s cubic-bezier(.46,.07,.04,.98);
    will-change: opacity,transform
}

.legend-wheel-img,.legend-wheel-inset {
    display: inline-block;
    position: absolute
}

.legend-wheel-inset {
    border-radius: 50%;
    margin: 3px;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
    border: 3px solid #3333338f;
    border-radius: 50%
}

.legend-wheel-arrow {
    background: transparent url(/images/wheel/arrow.png) 50% no-repeat;
    position: absolute;
    right: -40px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    width: 72px;
    height: 100%;
    z-index: 2
}

.legend-wheel-fade-enter-active,.legend-wheel-fade-leave-active {
    -webkit-transition: opacity .15s ease-in-out;
    transition: opacity .15s ease-in-out
}

.legend-wheel-fade-enter,.legend-wheel-fade-leave-to {
    opacity: 0
}

@media(max-width: 992px) {
    .legend-wheel-inset {
        box-shadow:inset 0 0 0 3px hsla(0,0%,100%,.1)
    }
}

@media(max-width: 767px) {
    #circle-container {
        margin-top:20px
    }

    .legend-wheel-inset {
        box-shadow: inset 0 0 0 2px hsla(0,0%,100%,.1)
    }

    .legend-wheel-arrow {
        background-size: 70%;
       
        
    }
}

.legend-wheel-inner {
    -webkit-box-align: center;
    align-items: center;
    background-color: #1e2226;
    border: 4px solid #1e2226;
    box-shadow: 0 0 0 10px rgba(0,0,0,.2),0 0 32px 0 rgba(0,0,0,.65);
    border-radius: 50%;
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
    width: 320px;
    height: 320px;
    z-index: 3
}

@media(max-width: 1199px) {
    .legend-wheel-inner {
        height:306px;
        width: 306px
    }
}

@media(max-width: 992px) {
    .legend-wheel-inner {
        box-shadow:0 0 0 8px rgba(0,0,0,.2),0 0 32px 0 rgba(0,0,0,.65);
        height: 295px;
        width: 295px
    }
}

@media(max-width: 767px) {
    .legend-wheel-inner {
        box-shadow:0 0 0 6px rgba(0,0,0,.2),0 0 32px 0 rgba(0,0,0,.65);
        height: 225px;
        width: 225px
    }
}

@media(max-width: 480px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 460px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 440px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 414px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 375px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 360px) {
    .legend-wheel-inner {
        height:215px;
        width: 215px
    }
}

@media(max-width: 330px) {
    .legend-wheel-inner {
        height:190px;
        width: 190px
    }
}

.legend-wheel-coefficient {
    -webkit-box-align: center;
    align-items: center;
    background-color: #fff;
    border-radius: 50%;
    position: absolute;
    min-height: 50%;
    min-width: 50%;
    max-width: 50%;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    will-change: opacity;
    color: #000
}

.legend-wheel-coefficient,.legend-wheel-coefficient-box {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    max-height: 50%
}

.legend-wheel-coefficient-box,.legend-wheel-coefficient-list {
    -webkit-box-align: start;
    align-items: flex-start
}

.legend-wheel-coefficient-list {
    display: -webkit-box;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    -webkit-box-pack: start;
    justify-content: flex-start;
    margin-left: 24px
}

.legend-wheel-coefficient-list:first-child {
    margin-left: 0
}

.legend-wheel-coefficient-item {
    -webkit-box-align: center;
    align-items: center;
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    margin-bottom: 12px
}

.legend-wheel-coefficient-item:last-child {
    margin-bottom: 0
}

.legend-wheel-coefficient-item>span {
    color: #000;
    font-weight: 400;
    font-stretch: normal;
    font-style: normal;
    font-size: 16px;
    margin-left: 7px;
    letter-spacing: normal;
    text-transform: uppercase
}

.legend-wheel-coefficient-enter-active,.legend-wheel-coefficient-leave-active {
    -webkit-transition: opacity .3s ease-in-out;
    transition: opacity .3s ease-in-out
}

.legend-wheel-coefficient-enter,.legend-wheel-coefficient-leave-to {
    opacity: 0
}

@media(max-width: 992px) {
    .legend-wheel-coefficient-list {
        margin-left:10px
    }

    .legend-wheel-coefficient-item {
        margin-bottom: 8px
    }

    .legend-wheel-coefficient-item>svg {
        width: 12px
    }
}

@media(max-width: 414px) {
    .legend-wheel-coefficient {
        min-height:54%;
        min-width: 54%;
        max-width: 54%;
        max-height: 54%
    }
}

@media(max-width: 330px) {
    .legend-wheel-coefficient {
        min-height:60%;
        min-width: 60%;
        max-width: 60%;
        max-height: 60%
    }
}

.legend-wheel-winner {
    background-color: #4e6588;
    border-radius: 50%;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    position: absolute;
    min-height: 50%;
    min-width: 50%;
    max-width: 50%;
    max-height: 50%;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    will-change: opacity
}

.legend-wheel-winner,.legend-wheel-winner-coefficient {
    -webkit-box-align: center;
    align-items: center;
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center
}

.legend-wheel-winner-coefficient {
    background-color: #fde907;
    border: 1px solid rgba(58,42,86,.3);
    border-radius: 15px;
    color: #3f2652;
    margin-top: 7px;
    padding: 2px 23px 4px;
    width: 82px;
    height: 27px;
    text-transform: uppercase
}

.legend-wheel-prize-decimal,.legend-wheel-prize-integer {
    color: #fff;
    font-family: Source Sans Pro,sans-serif;
    font-weight: 700;
    font-stretch: normal;
    font-style: normal;
    letter-spacing: normal
}

.legend-wheel-prize-integer {
    font-size: 36px;
    line-height: 1.5
}

.legend-wheel-prize-decimal {
    font-size: 26px;
    line-height: 1.23;
    white-space: nowrap
}

.legend-wheel-winner-box-shadow-orange .legend-wheel-winner-coefficient,.legend-wheel-winner-box-shadow-purple .legend-wheel-winner-coefficient,.legend-wheel-winner-box-shadow-red .legend-wheel-winner-coefficient {
    color: #fff
}

.legend-wheel-winner-enter-active {
    -webkit-transition: opacity .3s ease-in-out;
    transition: opacity .3s ease-in-out
}

.legend-wheel-winner-leave-active {
    -webkit-transition: opacity 0 ease-in-out;
    transition: opacity 0 ease-in-out
}

.legend-wheel-winner-enter,.legend-wheel-winner-leave-to {
    opacity: 0
}

@media(max-width: 992px) {
    .legend-wheel-winner-coefficient {
        font-size:12px;
        padding: 2px 16px 4px;
        width: 56px;
        height: 22px
    }
}

@media(max-width: 767px) {
    .legend-wheel-winner-coefficient {
        padding-bottom:3px;
        margin-top: 2px
    }

    .legend-wheel-prize-integer {
        font-size: 32px
    }

    .legend-wheel-prize-decimal {
        font-size: 20px
    }
}

@media(max-width: 414px) {
    .legend-wheel-winner {
        min-height:54%;
        min-width: 54%;
        max-width: 54%;
        max-height: 54%
    }
}

@media(max-width: 330px) {
    .legend-wheel-winner {
        min-height:60%;
        min-width: 60%;
        max-width: 60%;
        max-height: 60%
    }
}

.selectWheels.active {
    background-image: linear-gradient(to bottom,#2c80ff,#1d66ca);
    color: #fff;
    border: 2px solid #fff
}

.selectWheels {
   
    background: hsla(0,0%,100%,.1);
    border-radius: 4px;
    box-sizing: border-box;
   
    
    text-align: center;
    cursor: pointer;
    display: inline-table;
    
    -webkit-box-shadow: 0px 5px 25px -3px #3867d6;
    -moz-box-shadow: 0px 5px 25px -3px #3867d6;
    box-shadow: 0px 5px 25px -3px #3867d6;
    background: #3867d6;
}


                        </style>
                       
                        <div class="col-md">
                            <div class="card ecom-widget-sales">
                                <div class="" style="text-align:center">
		<div class=" height-100" id="circle-container" style="margin:0 auto;padding-left: 30px;max-width: 448px;max-height: 448px;">
                                <div class="legend-wheel" style="width: 418px; height: 418px;">
                                    <div class="legend-wheel-circle"><img src="images/wheel/1.png" class="legend-wheel-img">
                                        <div class="legend-wheel-inset"></div>
                                        <div class="legend-wheel-arrow"></div>
                                    </div>

                                    <div class="legend-wheel-inner">
                                       <div class="legend-wheel-coefficient">
                                            <div class="legend-wheel-coefficient-box"><div data-v-6fa0bf79="" class="legend-wheel-coefficient-list"><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#3a2a56" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X0.0</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#5e5afb" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X1.2</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#049acd" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X1.5</span></div></div></div>
                                        </div>
                                        <div class="legend-wheel-winner" style="display:none;">
                                            <span class="legend-wheel-winner-prize">
                                                <span class="legend-wheel-prize-integer">0</span>
                                            </span>
                                            <div class="legend-wheel-winner-coefficient" style="background-color:#ffffff;"> x0.00 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
		<style>
			@media(max-width:490px){
				.legend-wheel{
					    width: 250px!important;
    				height: 250px!important;
				}
			}
		</style>
		
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
    <script src="js/dashboard-ecom-widgets.js"></script>

</body>
 <script>
                        	
    $(".selectWheels").click(function(){

            var mode = $(this).attr("data-mode");
            $("label[data-mode]").removeClass('active');
            $("label[data-mode="+mode+"]").addClass('active');

            if(mode == 'easy'){
            $(".legend-wheel-winner").hide()
            $(".legend-wheel-img").attr("src","images/wheel/1.png");
            $(".legend-wheel-coefficient-box").html('<div data-v-6fa0bf79="" class="legend-wheel-coefficient-list"><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#3a2a56" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X0.0</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#5e57f6" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X1.2</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#0493c3" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X1.5</span></div></div>');
            $(".legend-wheel-img").css({"transform":"rotate(18deg)","transition":"0s"});      
        }
            if(mode == 'medium'){
                $(".legend-wheel-winner").hide()
                $(".legend-wheel-img").attr("src","images/wheel/2.png");
                $(".legend-wheel-coefficient-box").html('<div class="legend-wheel-coefficient-list" data-v-6fa0bf79=""><div class="legend-wheel-coefficient-item" data-v-6fa0bf79=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16" data-v-6fa0bf79=""><circle fill="#3a2a56" r="7" cx="7" cy="7" data-v-6fa0bf79=""></circle></svg> <span data-v-6fa0bf79="">X0.0</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#6058fc" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X1.5</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#049acc" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X2.0</span></div></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-list"><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#0de452" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X3.0</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#ca0ee7" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X5.0</span></div></div>');
                $(".legend-wheel-img").css({"transform":"rotate(147deg)","transition":"0s"});
            }
                if(mode == 'hard'){
                    $(".legend-wheel-winner").hide()
                    $(".legend-wheel-img").attr("src","images/wheel/3.png");
                    $(".legend-wheel-coefficient-box").html('<div class="legend-wheel-coefficient-list" data-v-6fa0bf79=""><div class="legend-wheel-coefficient-item" data-v-6fa0bf79=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16" data-v-6fa0bf79=""><circle fill="#3a2a56" r="7" cx="7" cy="7" data-v-6fa0bf79=""></circle></svg> <span data-v-6fa0bf79="">X0.0</span></div><div data-v-6fa0bf79="" class="legend-wheel-coefficient-item"><svg data-v-6fa0bf79="" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-1 -1 16 16"><circle data-v-6fa0bf79="" fill="#ca0ee7" r="7" cx="7" cy="7"></circle></svg> <span data-v-6fa0bf79="">X49.5</span></div></div>');
                    $(".legend-wheel-img").css({"transform":"rotate(97deg)","transition":"0s"});
                }

    })


function playWheel(){
    window.update_history = 1;
    var mode = $('.active').attr("data-mode");
    $('.legend-wheel-img').css({"transform":"rotate(0deg)","transition":"0s"})
    $('.error').css('display','none');
    if(mode == 'easy'){
        var key_mode = 18;
    }
    if(mode == 'medium'){
        var key_mode = 147;
    }
    if(mode == 'hard'){
        var key_mode = 97;
    }
    $.ajax({
        url: 'action.php',
        dataType: 'html',
        beforeSend: function(){
            $(".legend-wheel-winner").hide()
        },
        type: 'POST',
        data:{
            type: 'play_wheel',
            mode: mode,
            bet: $("#betwheel").val()
        },
        success: function(data){
            obj = $.parseJSON(data);
            if(obj.notification == 'error'){
                $('.error').css('display','block').text(obj.mess);
            }
            if(obj.notification == 'play'){
                var key = obj.key * 7.2 + key_mode + 360;
                $('.legend-wheel-img').css({"transform":"rotate("+key+"deg)","transition":"transform 5s cubic-bezier(.46,.07,.04,.98),-webkit-transform 4.5s cubic-bezier(.46,.07,.04,.98)"})
                $(".legend-wheel-winner-coefficient").text("x"+obj.win)
                $('.legend-wheel-prize-integer').text(obj.win_sum)

                setTimeout(function(){
                    $(".legend-wheel-winner").show()
                },5000);

                if(obj.win == 0){
                    $(".legend-wheel-winner").css({'box-shadow':'rgb(255, 255, 255) 0px 0px 80px 0px, rgb(255, 255, 255) 0px 0px 20px 0px, rgb(255, 255, 255) 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','rgb(255, 255, 255)')
                    $(".legend-wheel-winner-coefficient").text("x"+obj.win+".00")
                }
                if(obj.win == 1.2){
                    $(".legend-wheel-winner").css({'box-shadow':'#5e57f5 0px 0px 80px 0px, #5e57f5 0px 0px 20px 0px, #5e57f5 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#5e57f5')
                    $(".legend-wheel-winner-coefficient").text("x1.20")
                }
                if(obj.win == 1.5){
                    $(".legend-wheel-winner").css({'box-shadow':'#0498ca 0px 0px 80px 0px, #0498ca 0px 0px 20px 0px, #0498ca 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#0498ca')
                    $(".legend-wheel-winner-coefficient").text("x1.50")
                    if(mode == 'medium'){
                        $(".legend-wheel-winner").css({'box-shadow':'#5e57f5 0px 0px 80px 0px, #5e57f5 0px 0px 20px 0px, #5e57f5 0px 0px 5px 2px'});
                        $('.legend-wheel-winner-coefficient').css('background','#5e57f5')
                        $(".legend-wheel-winner-coefficient").text("x1.50")
                    }
                }
                if(obj.win == 2){
                    $(".legend-wheel-winner").css({'box-shadow':'#049acc 0px 0px 80px 0px, #049acc 0px 0px 20px 0px, #049acc 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#049acc')
                    $(".legend-wheel-winner-coefficient").text("x"+obj.win+".00")
                }
                if(obj.win == 3){
                    $(".legend-wheel-winner").css({'box-shadow':'#0de452 0px 0px 80px 0px, #0de452 0px 0px 20px 0px, #0de452 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#0de452')
                    $(".legend-wheel-winner-coefficient").text("x"+obj.win+".00")
                }
                if(obj.win == 5){
                    $(".legend-wheel-winner").css({'box-shadow':'#c20dde 0px 0px 80px 0px, #c20dde 0px 0px 20px 0px, #c20dde 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#c20dde')
                    $(".legend-wheel-winner-coefficient").text("x"+obj.win+".00")
                }
                if(obj.win == 50){
                    $(".legend-wheel-winner").css({'box-shadow':'#c20dde 0px 0px 80px 0px, #c20dde 0px 0px 20px 0px, #c20dde 0px 0px 5px 2px'});
                    $('.legend-wheel-winner-coefficient').css('background','#c20dde')
                    $(".legend-wheel-winner-coefficient").text("x"+obj.win+".00")
                }
                var money = obj.money;
                setTimeout(function(){
                    window.update_history = 0;
                    $('#balance').html(money)
                    $('#balance').attr('balance', obj.money);
                },5000)
            }
        }
    });
}
function sendMess(){
    var mess = $(".chat-options-input-text").val()
    if(mess.length > 2){
    $.ajax({
        url: "inc/engine.php",
            type: "POST",
            dataType: "html",
            data: {
                type: 'sendMess',
                mess: mess,
            },
            success: function(data){
                obj = $.parseJSON(data);
            $(".chat-options-input-text").val('')
            if(obj.success == 'false'){
                toastr['error'](obj.mess)
            }
            }
    })
    }else{
        toastr['error']('Введите больше двух символов')
    }
    }
    

    function amountInp(amount){
        var bet = $("#bet").val();
        switch (amount) {
            case 'x2':
              $('#bet').val(bet * 2)
              break;
            case '1/2':
                $('#bet').val(bet / 2)
              break;
            case 'min':
                $('#bet').val(1)
              break;
              case 'max':
                $('#bet').val(1000)
                break;
          }
    }
    
                        </script>
</html>
