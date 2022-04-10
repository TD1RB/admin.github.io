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
                        <div class="col">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">

                                  	<style>
						    .roulette {
   box-shadow: 0px 0px 20px 0px #0000007d;
border-bottom: 1px solid #0000004d;
   
    height: 85px;
    text-align: center;
    overflow: hidden;
    position: relative
}




.roulette:before {
            content: '';
            height: 100%;
            width: 3px;
            background: #3867d6;
            z-index: 10;
            box-shadow: 0 0 5px #3867d6;
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 0px;
            border-right: 0px ;
            border-top: 0px;
        }


        .roulette:after {
            content: '';
            position: relative;
            bottom: 0;
            left: 0%;
            z-index: 1;
            border-left: 0px;
            border-right: 0px ;
            border-top: 0px;
        }


.roulette .inbox {
    left: 50%;
    position: absolute;
    top: 3px;
    perspective: 1000px;
    -webkit-perspective: 1000px;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    -webkit-transform-style: preserve-3d;
    transition: none;
    transform: translateY(0);
    opacity: 1
}

.roulette .players {
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    -webkit-transform-style: preserve-3d;
    text-align: center;
    white-space: nowrap
}

.roulette img {
    border-radius: 3px;
    width: 78px;
    height: 78px;
    vertical-align: top;
    margin-right: 3px
}
#players {
    display: -webkit-box
}

#players .player {
    position: relative;
    width: 78px;
    margin-right: 15px
}

#players .player .add {
    position: absolute;
    top: -5px;
    right: -10px;
    color: #fff;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    text-align: center;
    cursor: pointer;
    z-index: 1
}

#players .team {
    display: flex;
    position: relative;
    margin-right: 15px;
}

#players .team .name {
    left: 0px;
    top: 0px;
    text-align: center;
    opacity: 0.9;
    z-index: 11;
    position: absolute;
    margin-top: 0;
    white-space: nowrap;
    overflow: hidden;
    padding: 3px 10px;
    text-overflow: ellipsis;
    font-size: 11px;
}

#players .team .player:last-child {
    margin-right: 0px;
}

.jackpot_player {
position: relative;
cursor: pointer;
display: inline-block;
margin: 10px;
}

.jackpot_player, .jackpot_player img {
width: 80px;
height: 80px;
border-radius: 50px;
}


.jackpot_player .user_chance {
width: 80px;
height:80px;
position: absolute;
background-image: linear-gradient(transparent, #3766d5);
right: 0px;
padding: 3px 0px 7px 0px;
padding-top:55px;
color: #fff;
font-size: 12px;
font-weight: 500;
text-align: center;
border-radius: 100%;
border-bottom-right-radius: 100%;
}
						</style>
						
						
						
						<div class="content-area card mb-1">
					    <div class="row" style="padding:10px;">
					    <div class="col" style="display:inline-block;color:white;font-size:25px;"><i class="fa fa-rub"></i> <span id="bank"style="font-weight:600">1.0</span></div>
					 <div class="col" style="display:inline-block;text-align: right;color:white;font-size:25px;"><span id="tcount"style="font-weight:600">22</span> <i class="fa  fa-clock-o"></i></div>
					</div>
					   
					</div>
						
					
						<br>
						
							<div class="content-area card mb-4" id="winner" style="display: none;">
					    <div class="row" style="padding:10px;">
					       
					    <div class="col-lg " style="text-align:center;display:inline-block;color:white;font-size:25px;"><span ><img width="40" id="sw_avatar" src="" class="rounded-circle"> </span></div>
					     <div class="col-lg " style="text-align:center;display:inline-block;color:white;font-size:25px;"><i class="fa fa-ticket text-danger pr-1"></i>Билет # <span id="sw_ticket">-</span></div>
				
					 
				</div>
					   
					</div>
					
					
							
							
					<div id="roulette" class="item mt-1 mb-4" style="display:none">
                <div id="choose_winner_div"class="roulette">
                    <div class="inbox">
                        <div class="players" id="choose_winner_list"style="transform: translate3d(600px, 0px, 0px); transition: all 10000ms cubic-bezier(0, 0, 0, 1) 0ms;"></div>
                    </div>
                </div>
            </div>
            
            
            
            <div class="p-2 rounded mb-4 mt-1 shadow-sm" id="players-block" style="background: none;box-shadow: 0px 0px 20px 0px #0000007d;border: 1px solid #0000004d;overflow: hidden;">
                <div id="players" class="scroll-block" style="margin: 0 auto;overflow-x: auto;overflow-y: hidden;">
                    
                   
           
    </div>
              
            </div>
            <div class="content-area card mb-2">
            <div style="padding:10px;padding-bottom:0px;padding-top:0px;"class="row">
							<div class="col-12">

								<form id="fbpnBet" name="fbpnBet" action="javascript:void(0);" autocomplete="off">
									<div class="form-row">
									
										<div class="col-md" style="margin-top: 15px;">
											<div class="btn-group d-flex" role="group">
											<input type="text" class="form-control" id="inputBetAmount" placeholder="Введите сумму..." autocomplete="off">
										</div>
										</div>
										
										<script>
                            filterInt = function (value) {
                              if(/^(\-|\+)?([0-9]+|Infinity)$/.test(value))
                                return Number(value);
                              return Number(value);
                            }
                        </script>
										<div class="col-md">
											<div class="btn-group d-flex" role="group">
												<button type="button" data-type="betSumm" onclick="$('#inputBetAmount').val(5)"data-value="5" class="fastBetsPanel btn btn-theme  waves-effect waves-light w-100">5</button>
												<button type="button" data-type="betSumm" onclick="$('#inputBetAmount').val(10)" data-value="10" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">10</button>
												<button type="button" data-type="betSumm" onclick="$('#inputBetAmount').val(25)" data-value="25" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">25</button>
												<button type="button" data-type="betSumm" onclick="$('#inputBetAmount').val(50)" data-value="50" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">50</button>
												<button type="button" data-type="x2" onclick="$('#inputBetAmount').val(((filterInt($('#inputBetAmount').val()))*2).toFixed(0));" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
											<button type="button" data-type="x2" onclick="$('#inputBetAmount').val(Math.max(($('#inputBetAmount').val()/2).toFixed(0), 1).toFixed(0));" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
												
											</div>
											<div class="d-block d-sm-none mb-2"></div>
										</div>
									
										<div class="col-md">
											<div class="btn-group d-flex" role="group">
												
												<button id="classicBet_1" form="fbpnBet" data-room="1" onclick="bet_ajax_send()"style="height:40px;"type="submit" class="btn btn-theme waves-effect w-100 ">Сделать ставку</button>
												
											</div>
										</div>
									
									</div>
									
										<div class="form-row">
										    	<div class="col" style="">
										
										<div class="progress mt-2" style="margin:auto;width:100%;height:10px;">
  <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated " role="progressbar" id="progress-bar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div>
										</div>
										    </div>
								</form>	

								
							</div>	
							

						</div>
						</div>
            <div class="content-area card mt-4 mb-2" id="btable">
						<div style="padding:10px;"class="text-white card-body ">
								
								<table class="table " style="padding: 7px 8px;">
								    
									<tbody id="betstable">
									    
									    

</tbody>
								</table>

						
						</div>
						</div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end ecom-widget-sales -->
                        </div>
                        <!-- end col -->
                       <? $user_id=0;?>

<script type="text/javascript">
"use strict";


var my_uid=<?=$user_id;?>;


var h_sound=0;





function vu_resize(){

}


vu_resize();


function show_message(message_text){
clearTimeout(message_time);

toastr["info"](message_text)

}


var bet_ajax=new XMLHttpRequest();
var message_time;
var bet_can=0;


function bet_ajax_send(){


if(bet_can==1){ return; }
bet_can=1;


var bet_ajax_vars="bet_sum="+document.getElementById("inputBetAmount").value;


bet_ajax.onreadystatechange=function(){
if(bet_ajax.readyState==4){
if(bet_ajax.status==200){
try{ eval(bet_ajax.responseText); }
catch(e){}
}
setTimeout("bet_can=0;",1500);
}
}
bet_ajax.open("POST","/ajax/room_bet.php?num=1",true);
bet_ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
bet_ajax.send(bet_ajax_vars);


}


function resize_img(){
var imgs=document.getElementById("players").getElementsByTagName("img");
var imgs_len=imgs.length;
for(var i=0;i<imgs_len;i++){
if(imgs[i]!=null){
if(imgs[i].height!=imgs[i].width){
imgs[i].height=imgs[i].width;
}
}
}
}


var up_ajax=new XMLHttpRequest();
var up_def=1;


function up_ajax_send(){
up_ajax.onreadystatechange=function(){
if(up_ajax.readyState==4){
clearTimeout(up_time);
if(up_ajax.status==200){
try{ eval(up_ajax.responseText); }
catch(e){}
}
if(up_def==1){
up_time=setTimeout("up_ajax_send();",2000);
}
}
}
up_ajax.open("POST","/ajax/room_up.php?num=1",true);
up_ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
up_ajax.send();
}


var vusers_hash="";


var started_time=new Date().getTime().toString().substr(0,10);
var now_time=0;
var elapsed_time=0;
var timer_hash_1=0;
var timer_1=0;
var timer_hash_2=0;
var timer_2=0;
var timer_show=0;


function timer_f(){
if(timer_hash_1!=timer_hash_2){
timer_hash_1=timer_hash_2;
timer_1=timer_2;
started_time=new Date().getTime().toString().substr(0,10);

}
now_time=new Date().getTime().toString().substr(0,10);

elapsed_time=now_time-started_time;
timer_show=timer_1-elapsed_time;

if(timer_show==-1){ timer_show=0; }
if(timer_show>=0){


// ТАЙМЕР ДЛЯ БОЛЬШЕ МИНУТЫ


if(timer_show>59){
var t_ns=timer_show;
var t_ps=parseInt(timer_show/60);
t_ns-=t_ps*60;
var t_nm=t_ps;
var t_pm=parseInt(t_ps/60);
t_nm-=t_pm*60;
var t_nh=t_pm;
if(t_nh<10){ t_nh="0"+t_nh; }
if(t_nm<10){ t_nm="0"+t_nm; }
if(t_ns<10){ t_ns="0"+t_ns; }
timer_show=t_nh+":"+t_nm+":"+t_ns;
if(t_nh=="00"){ timer_show=t_nm+":"+t_ns; }
}

if(timer_show < 10){
    document.getElementById("tcount").innerHTML=""+timer_show;
}
if(document.getElementById("tcount").innerHTML!=timer_show){
document.getElementById("tcount").innerHTML=timer_show;
}

if(timer_show == 0){
    document.getElementById("tcount").innerHTML=30;
}
//100% - 30сек
//x - 20сек    283



var w =  100 * timer_show / 30;
//$("#timeline").width(w);
document.getElementById('progress-bar').style.width = w+'%';
if(timer_show == 0){
document.getElementById('progress-bar').style.width = '100%';
    
}

if((timer_show==0 || timer_show>9) && document.getElementById("tcount").className=="blinkme"){ document.getElementById("tcount").className=""; }
if((timer_show>0 && timer_show<10) && document.getElementById("tcount").className==""){ document.getElementById("tcount").className="blinkme"; }
}
}


setInterval("timer_f();",100);


var last_id=<?=$user_id;?>;


var sw_last_id,sw_p_url,sw_uid,sw_login,sw_percent,sw_avatar,sw_sum_full,sw_sum_real,sw_sum_bet,sw_avatars;
var sw_pre_list=[];
var sw_list=[];
var sw_ins_list="";


var sw_left=0;
var sw_target=0;
var sw_speed=0;
var sw_inc=0;
var sw_right=3200;
var sw_max=0;


var sw_mode=0;
var sw_balance=0;
var sw_money=0;


var balance_coin_time;
var money_coin_time;


var mobile=0;


function set_list(){
    $('#bank_time').hide();
document.getElementById("choose_winner_list").innerHTML="";
for(var b=0;b<sw_pre_list.length;b++){
for(var h=0;h<sw_pre_list[b][0];h++){
sw_list.push("<img src="+sw_pre_list[b][1]+">");
}
}
sw_list.sort(function() { return 0.5-Math.random(); } );
sw_list[60]="<img src="+sw_avatar+">";
for(var b=0;b<sw_list.length;b++){
sw_ins_list+=sw_list[b];
}
document.getElementById("choose_winner_list").innerHTML=sw_ins_list;
sw_pre_list=[];
sw_list=[];
sw_ins_list="";
}


function show_winner(){
    

	    $.ajax({
                                               type: 'POST',
                                                  url: 'action.php',
           data: {
                                                                                    type: "rotate_j",
                                                                                   
                                                                                   
                                                                                },
                                        success: function(data) {
                                            var obj = (data);
                                            if (obj.success == "success") {
                                             var random =  obj.random;
                                            var signature = obj.signature;
		
                                         	$('#jackpot_random').val(random);
										$('#jackpot_sign').val(signature);
                                            }else{
												notify("warning",obj.error);
											}
                                        }
                                    });
                                    
document.getElementById("winner").style.display="block";
// updateBalance(0, '<?=$balance;?>');
//$('#mybalance').load('../game/main.php #mybalance')
if(sw_uid==my_uid){


//var myb=document.getElementById("my_balance").innerHTML.replace(/[^0-9\.]*/g,"");
//myb=Number(myb)+Number(sw_balance);
//myb=myb.toFixed(4);
//document.getElementById("mybalance").innerHTML=myb;





if(sw_mode==3 || sw_mode==4){
document.getElementById("balance_coin").style.display="block";
clearTimeout(balance_coin_time);
balance_coin_time=setTimeout('document.getElementById("balance_coin").style.display="none";',3000);
}


if(sw_mode==1 || sw_mode==2 || sw_mode==4){
document.getElementById("money_coin").style.display="block";
clearTimeout(money_coin_time);
money_coin_time=setTimeout('document.getElementById("money_coin").style.display="none";',3000);
}


if(h_sound==1){
document.getElementById("win_sound").play();
}
}
}


function reset_bets(){
     $('.fa-clock-o').removeClass('fa-spin');
    up_def=1;
up_ajax_send();
$('#roulette').hide();
document.getElementById("choose_winner_list").style.transform="translate3d(600px, 0px, 0px)";
document.getElementById("winner").style.display="none";
 


document.getElementById("players").innerHTML='<table class="room_u_table" cellpadding="5" cellspacing="0"><tr><td class="room_u_wait">Ожидание игроков...</td></tr></table>';

up_def=1;
up_ajax_send();

if(last_id!=sw_last_id){
last_id=sw_last_id;
if(mobile==0){
winners_list.push('<td class="room_w_text_2" style="text-align:center;">\'+sw_last_id+\'</td><td class="room_w_avatar" width="50px"><a target="_blank" href="\'+sw_p_url+\'"><img src="\'+sw_avatar+\'" /></a></td><td class="room_w_text_1" width="200px"><a target="_blank" href="\'+sw_p_url+\'">\'+sw_login+\'</a></td><td class="room_w_text_2" width="150px">\'+sw_sum_full+\' р.</td><td class="room_w_text_1" width="150px">\'+sw_percent+\'%</td><td class="room_w_text_2" width="150px">\'+sw_sum_bet+\' р.</td>');
}
else{
//winners_list.push(\'<td class="room_w_avatar" width="50px"><a target="_blank" href="\'+sw_p_url+\'"><img src="\'+sw_avatar+\'" /></a></td><td class="room_w_text_1" width="200px"><a target="_blank" href="\'+sw_p_url+\'">\'+sw_login+\'</a></td><td class="room_w_text_2" width="150px">\'+sw_sum_full+\' р.</td><td class="room_w_text_1" width="150px">\'+sw_percent+\'%</td><td class="room_w_text_2" width="150px">\'+sw_sum_bet+\' р.</td>\');
}
}


up_def=1;
up_time=setTimeout("up_ajax_send();",500);
}



function scroll_users(){
	
	
                                    



    $('.fa-clock-o').addClass('fa-spin');
  

   //document.getElementById("choose_winner_list").style.transform="translate3d(-4876px, 0px, 0px)"; 

if(sw_left>sw_target){
    $('#message').show();


return;
}
requestAnimationFrame(scroll_users);
if(sw_left<sw_right){
sw_speed+=0.1*sw_inc;
if(sw_speed>sw_max){ sw_speed=sw_max; }
}
else{
sw_speed=-(sw_left-sw_target)/sw_target*50*sw_inc+0.2;
}
sw_left+=sw_speed;
console.log(sw_left);
//document.getElementById("choose_winner_list").style.transform="translate3d("+-sw_left+"px, 0px, 0px)"; 
//document.getElementById("choose_winner_list").style.left=-sw_left+"px";
}


var up_time=setTimeout("up_ajax_send();",500);


</script>
                        
                        <!-- end col -->
                      
                        <style>
                        .mines-bets{
                          width:300px;
                          height: 300px;
                          padding: 0px;
                          padding-top:0px;

                        }
                          .btn-mines{
                            position: relative;
                            width:50px;
                            height: 50px;
                            margin-top: 2px!important;
                            margin-left: 2px!important;
                            margin-right: 2px!important;
                          }
                        </style>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                     <? require('components/history.php'); ?>
                <!-- end animated fadeIn -->
            </div>
            <!-- end container-fluid -->
        </main>
        <!-- end main -->

<? if($adm == 1){?>
<script>
function podcrutka(id_user){
	$.ajax({
       type: 'POST',
       url: '../action.php',
beforeSend: function() {    },  

    data: {
    type: "fart_j",
    id_user: id_user                                                                         
     },
         success: function(data) {
     var obj = data;
     if(obj.fa != 'success') {
     	
     	toastr["error"](obj.error)
       	
        return false;
     }
     if(obj.fa == 'success') {
     		toastr["success"]('Вы успешно подкрутили игроку '+obj.login+'!')
     	
    $('#balance').html(obj.new_balance);
  
     }
     
    }
  }); 

}
</script>

<?}?>





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
