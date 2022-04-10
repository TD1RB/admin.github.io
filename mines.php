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
        <div class="col-lg-3">
          <div class="card ecom-widget-sales">
            <div class="card-body">

              <form>
                <div class="form-group">
                  <label for="exampleInputEmail1">Сумма ставки</label>
                  <input type="number" class="form-control"  value="1" id="inputBetAmount" aria-describedby="emailHelp">
                  <div class="btn-group d-flex "  role="group">
                    <button type="button" data-type="x2" onclick="var x = ($('#inputBetAmount').val()*2);$('#inputBetAmount').val(parseFloat(x.toFixed(2)));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">X2</button>
                    <button type="button" data-type="x2" onclick="$('#inputBetAmount').val(Math.max(($('#inputBetAmount').val()/2).toFixed(2), 1));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">/2</button>
                    <button type="button" data-type="x2" onclick="$('#inputBetAmount').val(1);updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Min</button>
                    <button type="button" data-type="x2" onclick="$('#inputBetAmount').val($('#balance').attr('mybalance'));updateProfit()" data-value="" class="fastBetsPanel btn btn-theme waves-effect waves-light w-100">Max</button>

                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Кол-во бомб</label>
                  <input type="number" class="form-control" data-minesin="" id="betBombMines" aria-describedby="emailHelp" value="3">

                  <div class="btn-group d-flex" role="group">
                    <button type="button" data-type="betSumm" onclick="_mines.setXS(3);$('#betBombMines').val(3)"data-value="5" class="btn btn-theme  w-100">3</button>
                    <button type="button" data-type="betSumm" onclick="_mines.setXS(5);$('#betBombMines').val(5)" data-value="10" class=" btn btn-theme w-100">5</button>
                    <button type="button" data-type="betSumm" onclick="_mines.setXS(10);$('#betBombMines').val(10)" data-value="25" class=" btn btn-theme  w-100">10</button>
                    <button type="button" data-type="betSumm" onclick="_mines.setXS(24);$('#betBombMines').val(24)" data-value="25" class=" btn btn-theme  w-100">24</button>

                  </div>
                </div>
              </form>

              <div class="text-center btn-tool-bar">
                <button class="btn btn-theme w-100 start-game-btn" data-btn="game" onclick="startgameMine();">Играть</button>
                <div class="finish-game-btn">
                <button id="finishmines" disabled="disabled"class=" btn w-100  btn-theme " data-btn="collect" onclick="finishgameMine();">Забрать: <span id="win">0.00</span></button>
                <button id="automines" class="btn w-100  btn-theme mt-4" data-btn="collect"  onclick="autoselect_mines()">Автовыбор </button>
</div>
              </div>
              <!-- end btn-tool-bar -->
            </div>
            <!-- end card-body -->
          </div>
          <!-- end ecom-widget-sales -->
        </div>
        <!-- end col -->
        <style>

        </style>
        <div class="col-lg ">
          <div class="card ecom-widget-sales">
            <div class="card-body">
              <center>
                <div class="mines-bets">
                  <button onclick="b(1)" id="b1" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(2)" id="b2" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(3)" id="b3" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(4)" id="b4" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(5)" id="b5" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(6)" id="b6" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(7)" id="b7" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(8)" id="b8" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(9)" id="b9" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(10)" id="b10" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(11)" id="b11" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(12)" id="b12" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(13)" id="b13" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(14)" id="b14" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(15)" id="b15" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(16)" id="b16" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(17)" id="b17" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(18)" id="b18" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(19)" id="b19" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(20)" id="b20" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(21)" id="b21" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(22)" id="b22" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(23)" id="b23" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(24)" id="b24" class="btn btn-theme btn-mines"></button>
                  <button onclick="b(25)" id="b25" class="btn btn-theme btn-mines"></button>

                </div>
                <div id="mines-alert"></div>
                 <div class="diamons blockright" style="display:none"><i class="far fa-gem animated zoomIn"></i><span>23</span></div>
            <div class="minebomb blockright" style="display:none"><i class="fas fa-bomb animated zoomIn"></i><span>2</span></div>
                <div class="row mt-2 mt-lg-0">
                  <div class="col-lg" style="position: relative;">
            <div class="xs"><div class="item" data-p="1" data-mine="1.09">1.09x</div><div class="item" data-p="2" data-mine="1.19">1.19x</div><div class="item" data-p="3" data-mine="1.3">1.3x</div><div class="item" data-p="4" data-mine="1.43">1.43x</div><div class="item" data-p="5" data-mine="1.58">1.58x</div><div class="item" data-p="6" data-mine="1.75">1.75x</div><div class="item" data-p="7" data-mine="1.96">1.96x</div><div class="item" data-p="8" data-mine="2.21">2.21x</div><div class="item" data-p="9" data-mine="2.5">2.5x</div><div class="item" data-p="10" data-mine="2.86">2.86x</div><div class="item" data-p="11" data-mine="3.3">3.3x</div><div class="item" data-p="12" data-mine="3.85">3.85x</div><div class="item" data-p="13" data-mine="4.55">4.55x</div><div class="item" data-p="14" data-mine="5.45">5.45x</div><div class="item" data-p="15" data-mine="6.67">6.67x</div><div class="item" data-p="16" data-mine="8.33">8.33x</div><div class="item" data-p="17" data-mine="10.71">10.71x</div><div class="item" data-p="18" data-mine="14.29">14.29x</div><div class="item" data-p="19" data-mine="20">20x</div><div class="item" data-p="20" data-mine="30">30x</div><div class="item" data-p="21" data-mine="50">50x</div><div class="item" data-p="22" data-mine="100">100x</div><div class="item" data-p="23" data-mine="300">300x</div></div>
</div></div>
              </center>
              <!-- end btn-tool-bar -->
            </div>
            <!-- end card-body -->
          </div>
          <!-- ecom-widget-sales -->
        </div>
        <!-- end col -->
        <style>
        .xs .active {
    box-shadow: 0px 0px 20px #3665d57d;
    background: #3665d57d;
}
        .xs {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 70px;
    background: none;
    display: -webkit-box;
    padding: 15px;
    right: 2px;
    overflow-y: hidden;
    overflow-x: auto;
}
.xs {
    /*overflow: hidden;*/
}
@media(max-width: 900px){
  .xs {
    position: relative;
}
}
        .xs .item {
    width: 120px;
    height: 39px;
    line-height: 36px;
    border-radius: 4px;
    margin-right: 20px;
    font-size: 20px;
    border: 1px solid rgba(255, 255, 255, 0.11);
    text-align: center;
}
        .finish-game-btn {
		display: none;
	}
        </style>
        <script>

    var _mines = {
        mine: 2,
        active: false,
        p: 0,
        game: false,
        xs: JSON.parse(`{"2":[1.09,1.19,1.3,1.43,1.58,1.75,1.96,2.21,2.5,2.86,3.3,3.85,4.55,5.45,6.67,8.33,10.71,14.29,20,30,50,100,300],"3":[1.14,1.3,1.49,1.73,2.02,2.37,2.82,3.38,4.11,5.05,6.32,8.04,10.45,13.94,19.17,27.38,41.07,65.71,115,230,575,2300],"4":[1.19,1.43,1.73,2.11,2.61,3.26,4.13,5.32,6.95,9.27,12.64,17.69,25.56,38.33,60.24,100.4,180.71,361.43,843.33,2530,12650],"5":[1.25,1.58,2.02,2.61,3.43,4.57,6.2,8.59,12.16,17.69,26.54,41.28,67.08,115,210.83,421.67,948.75,2530,8855,53130],"6":[1.32,1.75,2.37,3.26,4.57,6.53,9.54,14.31,22.12,35.38,58.97,103.21,191.67,383.33,843.33,2108.33],"7":[1.39,1.96,2.82,4.13,6.2,9.54,15.1,24.72,42.02,74.7,140.06,280.13,606.94,1456.67,4005.83,13352.78],"8":[1.47,2.21,3.38,5.32,8.59,14.31,24.72,44.49,84.04,168.08,360.16,840.38,2185,6555,24035,120175,1081575],"9":[1.56,2.5,4.11,6.95,12.16,22.12,42.02,84.04,178.58,408.19,1020.47,2857.31,9286.25,37145,204297.5,2042975],"10":[1.67,2.86,5.05,9.27,17.69,35.38,74.7,168.08,408.19,1088.5,3265.49,11429.23,49526.67,297160,3268760],"11":[1.79,3.3,6.32,12.64,26.54,58.97,140.06,360.16,1020.47,3265.49,12245.6,57146.15,371450,4457400],"12":[1.92,3.85,8.04,17.69,41.28,103.21,280.13,840.38,2857.31,11429.23,57146.15,400023.08,5200300],"13":[2.08,4.55,10.45,25.56,67.08,191.67,606.94,2185,9286.25,49526.67,371450,5200300],"14":[2.27,5.45,13.94,38.33,115,383.33,1456.67,6555,37145,297160,4457400],"15":[2.5,6.67,19.17,60.24,210.83,843.33,4005.83,24035,204297.5,3268760],"16":[2.78,8.33,27.38,100.4,421.67,2108.33,13352.78,120175,2042975],"17":[3.13,10.71,41.07,180.71,948.75,6325,60087.5,1081575],"18":[3.57,14.29,65.71,361.43,2530,25300,480700],"19":[4.17,20,115,843.33,8855,177100],"20":[5,30,230,2530,53130],"21":[6.25,50,575,12650],"22":[8.33,100,2300],"23":[12.5,300],"24":[25]}`),
        calc: function (type, value) {
            if(_mines.game) return toastr["error"]("Активная игра");
            if($('.mines-bg [name="amount"]').attr('disabled')) return false;
            let amount = parseFloat($('.mines-bg [name="amount"]').val());
            if(!amount) amount = 1;
            if(type == 1) amount += value;
            else if(type == 2) amount *= value;
            else if(type == 3) amount /= value;
            let user_money = parseFloat($('#balance-ajax').text());
            if(amount > user_money) amount = user_money;
            return $('.mines-bg [name="amount"]').val(parseFloat(amount).toFixed(2));
        },
        setXS: (x) => {
            if(_mines.game) return toastr["error"]("Активная игра");

            let array = (_mines.xs[x]).slice(0), html = "";
            $(' .xs').html("");
            $('[data-minesin]').val(x);
            let diamons = 25 - parseInt(x);
            $('.diamons span').text(diamons);
            $('.minebomb span').text(25 - diamons);
            _mines.mine = x;
            for(let i in array) $('.xs').append('<div class="item" data-p="'+ (parseInt(i) + 1) +'" data-mine="'+ array[i]+'">'+ array[i] +'x</div>');
        }
    };

    document.querySelector('[data-minesin]').oninput = () => _mines.setXS(document.querySelector('[data-minesin]').value);
    _mines.setXS(3);

    _mines.place = function(place) {

        if(_mines.active) return false;
        $.sound("/stairsgame/huyznaetchto.mp3", 0.5, true, false);

        $.post('/mines/bet', {
            place: place
        }, async (data) => {

            if(data.status == "error") return toastr['error'](data.msg);

            $('[data-btn="collect"]').html('Забрать выигрыш: ' + parseFloat(data.win).toFixed(2));
            $('[data-place="'+ place +'"]').addClass('active').attr("onclick", false);

            if(data.lose) return _mines.end(data.mines, ["error", "Вы проиграли ;c", "smert"], `<div class="modal-pole lose">
                    <div class="sum">x${ data.x }</div>
                    <div class="description">Вы проиграли ;c</span></div>
            </div>`);
            else if(data.end) return _mines.end(data.mines, ["success", "С победой.", "win"], `<div class="modal-pole win">
                    <div class="sum">x${ data.x }</div>
                    <div class="description">Вы выиграли <span>${ parseFloat(data.win).toFixed(2) }</span></div>
            </div>`);

            _mines.p++;
            $(`[data-p]`).removeClass("active");
            $(`[data-p="${ _mines.p }"]`).addClass("active");
            $('.mines .xs').stop().animate({ scrollLeft: `${ (_mines.p - 2) * 140 }px` }, 800);
            $('.mines .diamons span').text(parseInt($('.mines .diamons span').text()) - 1);

            $.sound("/stairsgame/blyanesdoh.mp3", 0.5, true, false);
            return $('[data-place="'+ place +'"]').html(`<i class="far fa-gem animated zoomIn"></i>`);

        }).fail(() => {
            _mines.active = false;
            return toastr["error"]("Ошибка отправки запроса");
        });

    };

    _mines.money = () => {
        if(_mines.active) return false;
        $.get('/mines/collect', (data) => {
            if(data.status == 'error') return toastr['error'](data.msg);
            return _mines.end(data.mines, ["success", "С победой.", "win"], `<div class="modal-pole win">
                    <div class="sum">x${ data.x }</div>
                    <div class="description">Вы выиграли <span>${ parseFloat(data.win).toFixed(2) }</span></div>
            </div>`);
        }).fail(() => toastr["error"]("Ошибка отправки запроса"));
    };

    _mines.end = (mine, type, alert) => {
        _mines.game = false;
        $.user.update();
        $('[data-btn="game"]').show();
        $('[data-btn="collect"]').hide();
        toastr[type[0]](type[1]);
        // Sound
        $.sound("/stairsgame/"+ type[2] +".mp3", 0.5, true, false);
        $('.mines-bg input').attr('disabled', false);
        // Mines
        $('[data-place]').html(`<i class="far fa-gem animated zoomIn"></i>`);
        for(let i in mine) $('[data-place="'+ mine[i] +'"]').html(`<i class="far fa-bomb animated zoomIn"></i>`);

        if(alert) $('#mines-alert').html(alert);

        // return
        return true;
    };



</script>
        <script >
        
function autoselect_mines(){
    $.ajax({
        url: "action.php",
            type: "POST",
            dataType: "html",
            data: {
                type: 'autoselect_mines',
            },
            success: function(data){
                obj = JSON.parse(data);
                if(obj.success == 'true'){
                	
                  b(obj.select)
                    $('.finish-game-btn').show();
                                        $('.start-game-btn').hide();
                                        $('.start-game-btn').attr('disabled', 'disabled');
                                        $('.finish-game-btn').removeAttr('disabled', 'disabled');
                    $("#startmines").attr("disabled","disabled");
       $("#finishmines").removeAttr("disabled","disabled");
                }
            }
})
}
minesnew();
          function minesnew(){
            $.ajax({
              type: 'POST',
              url: 'action.php',

              data: {
                type: "minesnew",
              },
              success: function(data) {
               var obj = data;

               if (obj.success == "success") {
                if(obj.win != ''){
                  $('#inputBetAmount').val(obj.bet);

                  $('#win').html(obj.win);   


                  mine = JSON.parse(obj.click);
                  lm = mine.length;

                  for(i=0;i<lm;i++){
                   $("#b"+mine[i]).removeClass('btn-theme').addClass('btn-success').html("");
                 }
                 $('.finish-game-btn').show();
                                        $('.start-game-btn').hide();
                                        $('.start-game-btn').attr('disabled', 'disabled');
                                        $('.finish-game-btn').removeAttr('disabled', 'disabled');
                 $("#startmines").attr("disabled","disabled");
                 $("#finishmines").removeAttr("disabled","disabled");

               }}
             }
           });
          }

          var scroll = true;
var path = "mine.php"; //Для удобства

function startgameMine(){
	$('#mines-alert').html('');
  $(`[data-p]`).removeClass("active");
  $('#minesgamecheck1').hide();
  $("#startmines").attr("disabled","disabled");
  var bet = $("#inputBetAmount").val();
  var mine = "mine";
  $.ajax({
    url: "mine.php",
    type: "POST",
    dataType: "html",
    data: {
      type: mine,
      mines: $("#betBombMines").val(),
      bet: bet,
    },
    success: function(response){
      obj = $.parseJSON(response);
      if(obj.info == "warning"){
       toastr["error"](obj.warning)
       
       $("#startmines").removeAttr("disabled","disabled");

     }else{
      if(obj.info == "true"){
        $("#win").html("0.00");
        $("#MineProfit").html("1.00");
        $(".allin-win").css("visibility","visible");


        for(i=0;i<26;i++){

          $("#b"+i).css('opacity','1').removeClass("btn-danger btn-success btn-theme").addClass('btn-theme').removeAttr("disabled","disabled").html("");
        }
        $('.start-game-btn').hide();
        $('.finish-game-btn').show();
                                        $('.start-game-btn').attr('disabled', 'disabled');
                                        $('.finish-game-btn').removeAttr('disabled', 'disabled');
        $("#startmines").attr("disabled","disabled");
        $("#finishmines").removeAttr("disabled","disabled");
        toastr["success"]("Игра началась")

        
        $('#balance').html(obj.money);
        $('#mobbalance').html(obj.money);
        $('#balance').attr('myBalance', obj.money);
        //$(".mine-circle").attr("disabled","disabled");
        aa = $("#betBombMines").val();
      }
      if(obj.info == "false"){
        toastr["error"]("У вас активная игра")


      }
    }
  }
});
};
if(1 > 0){

  function b(bombs){


    var pressmine = bombs;
    $.ajax({
     url: path,
     type: "POST",
     dataType: "html",
     data: {
       mmine: pressmine,
     },
   success: function(response){ //response
     obj = $.parseJSON(response); //response
     if(obj.info == "warning"){
       noty({
        layout:'bottomLeft',
        textAlign:'center',
        text: obj.warning,
        type: 'error',
        timeout: 4000,
      });

     }
     if(obj.info == "click"){
      if(obj.bombs == "true"){
      	$('#mines-alert').html('<div class="modal-pole lose"><div class="sum">x0</div><div class="description">Вы проиграли :(</span></div></div>');
      	$('.start-game-btn').show();
                                                $('.finish-game-btn').hide();
                                                $('.finish-game-btn').attr('disabled', 'disabled');
                                                $('.start-game-btn').removeAttr('disabled', 'disabled');
        $("#startmines").removeAttr("disabled","disabled");
        $("#finishmines").attr("disabled","disabled");
        $('#minesgamecheck1').show();

        $('#minesgamecheck1').html('<div class="chat-group-divider">Проверка игры</div><input onclick="gamecheck('+obj.game_id+')"class="btn btn-success form-control col-12  " href="#" data-toggle="modal" data-target="#minesgamecheck"  type="button" value="Проверить игру" >');

//gamecheck(obj.game_id);

           //$(".mine-circle").removeAttr("disabled","disabled");
           $("#win").html("0.00");
           //$("#nextRewardBoxBomb").text("1.03");
           
           for(i=0;i<26;i++){



            if(!$("#b"+i).hasClass("btn-success")) {
              $("#b"+i).css('opacity','0.5').removeClass('btn-theme').addClass('btn-success');
            }
          }

          $("#b"+bombs).css('opacity','1').removeClass('btn-theme').addClass('btn-danger');       
          obj.tamines = $.parseJSON(obj.tamines);
          for(i = 0; i < obj.tamines.length; i++){
            if(!$("#b"+obj.tamines[i]).hasClass("btn-danger")) {
              $("#b"+obj.tamines[i]).css('opacity','0.5').addClass('btn-danger');
            }


            $('.odometer').html(obj.money);
            $('#balance').attr('balance', obj.money);
          };

          // $("#bombHistoryContent").prepend(obj.resultHistoryContentBomb);
        }else{
         miner = obj.step
         $('#win').html(obj.win);
var min =  $('#betBombMines').val();
                         var win = obj.win;
                         var win = win.replace(/[\.\/]/g,'_');

                         $("#mines"+min+"_"+win).addClass("coeff-item-active ");
                 $('.diamons span').text(obj.gem);

                         $("#mines"+min+"_"+win).removeClass("coeff-item");
                           $(`[data-p]`).removeClass("active");
            $(`[data-p="${ miner }"]`).addClass("active");

                     $('.xs').stop().animate({ scrollLeft: `${ (miner - 2) * 140 }px` }, 800);

         $("#b"+obj.pressmine).removeClass('btn-theme').addClass("btn-success");
         $("#startmines").attr("disabled","disabled");
         $("#finishmines").removeAttr("disabled","disabled");
         $("#MinesProfit").text(obj.win);
         $("#b"+obj.pressmine).attr("disabled","disabled");
          // $("#historyGameContentBombGame").text("Поле " +pressmine+" оказалось призовым");
          $("#MineProfit").text(obj.nextX);
           //прокрутка истории действий
           if(obj.nextX > 0){

           }else{
             finishgameMine();
           }
         }
       }
     }
   })

  }
}else{
  toastr["error"]("Не спеши")

};

function finishgameMine(){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "html",
    data: {
      finish: true,
    },
    success: function(response){
     obj = $.parseJSON(response);
     
     if(obj.info == "warning"){
     	toastr["error"](obj.warning)


     }else{
       obj.tamines = $.parseJSON(obj.tamines);
       if (obj.info = true){
         for(i=0;i<26;i++){
        //$(".mine[data-number="+i+"]").removeClass("win-mine").removeAttr("disabled","disabled").text("");
        //$(".mine[data-number="+i+"]").removeClass("lose-mine fas fa-bomb").removeAttr("disabled","disabled").text("");
      }


         //$('#minesgamecheck1').show();
         
         //$('#minesgamecheck1').html('<div class="chat-group-divider">Проверка игры</div><input onclick="gamecheck('+obj.game_id+')"class="btn btn-success form-control col-12  " href="#" data-toggle="modal" data-target="#minesgamecheck"  type="button" value="Проверить игру" >');
$('#mines-alert').html('<div class="modal-pole win"><div class="sum">x'+obj.caef+'</div><div class="description">Вы выиграли <span>'+obj.win+'</span></div></div>');

$('.start-game-btn').show();
                                        $('.finish-game-btn').hide();
                                        $('.start-game-btn').removeAttr('disabled', 'disabled');
                                        $('.finish-game-btn').attr('disabled', 'disabled');
         $('#balance').html(obj.money);
         $('#mobbalance').html(obj.money);

         $('#balance').attr('myBalance', obj.money);
         $("#startmines").removeAttr("disabled","disabled");
         $("#finishmines").attr("disabled","disabled");
       //$("#historyGameContentBombGame").text("Нажмите 'играть' чтобы начать игру");
       //$("#bombHistoryContent").prepend(obj.resultHistoryContentBomb);
       
       for(i=0;i<26;i++){

         if(!$("#b"+i).hasClass("btn-success")) {
          $("#b"+i).css('opacity','0.5').removeClass('btn-theme').addClass('btn-success');
        }
      }


      for(i = 0; i < obj.tamines.length; i++){

      //$(".mine[data-number="+obj.tamines[i]+"]").addClass('lose-mine fas fa-bomb');
      if(!$("#b"+obj.tamines[i]).hasClass("btn-danger")) {
        $("#b"+obj.tamines[i]).css('opacity','0.5').removeClass('btn-theme').addClass('btn-danger');
      }
    }


  }
}

},
})
};



function openMines(id){
  $.ajax({
    url: path,
    type: "POST",
    dataType: "HTML",
    data: {
      openMines: 'openMines',
      idMines: id,
    },
    success: function(response){
      obj = $.parseJSON(response);
      obj.minesopen = $.parseJSON(obj.minesopen);


      $('#open-mines-modal').modal();
      $(".openMines").html(obj.minesopen);
      $("#idbetMines").text(obj.idbetMines);
      $("#coefMinesOpen").text(obj.coefMinesOpen);

      if(obj.loseBomb != null){
        $(".openMines[data-number="+obj.loseBomb+"]").addClass("lose-mine fas fa-bomb");
      }
$("#openMinesLogin").text(obj.loginMinesOpen); //attr("onclick='+obj.idUsersOpen+'")
$("#winminesOpen").text(obj.winminesOpen);

}
}
) 

}

</script>
<style>
.modal-pole.lose {
    border: 3px solid #c82333;
}
.modal-pole.win .description span, .modal-pole.win .sum {
    color: #27ae60;
}
.modal-pole .sum {
    font-weight: bold;
    font-size: 30px;
}
.modal-pole .description {
    color: gray;
}
.modal-pole.win {
    border: 3px solid #27ae60;
}
.modal-pole {
    position: absolute;
    left: 0;
    border-radius: 10px;
    top: 0;
    right: 0;
    box-shadow: 2px 2px 20px rgb(0 0 0 / 54%);
    bottom: 70px;
    text-align: center;
    background: rgba(0, 0, 0, 0.58);
    padding: 30px;
    width: 300px;
    height: 140px;
    margin: auto;
    z-index: 99999999;
}
  .mines-bets{
    width:400px;
    height: 400px;
    padding: 0px;
    padding-top:0px;

  }
  .btn-mines{
    position: relative;
    width:60px;
    height: 60px;
    margin-top: 2px!important;
    margin-left: 2px!important;
    margin-right: 2px!important;
  }
  @media (max-width: 450px){
.mines-bets {
    width:300px;
    height: 300px;
    padding: 0px;
    padding-top:0px;

  }
  }
  @media (max-width: 450px){
  .btn-mines{
    position: relative;
    width:50px;
    height: 50px;
    margin-top: 2px!important;
    margin-left: 2px!important;
    margin-right: 2px!important;
  }}
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
