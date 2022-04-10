<!DOCTYPE html>
<?php


session_start();
$sid = $_SESSION['hash'];

if(!$sid){
	header('Location: /index');
	require('index.php');
	exit();
}
else{
require('components/header.php');
}
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
                                    <h4 class="text-theme">Профиль</h4>
                                    <br/>
                                    <center>
                                    	<img style="width:100px;height:100px;border-radius:10px;box-shadow: 0px 5px 25px -3px #3867d6;"src="<?=$img;?>">
                                   <br><br><h5><span><?=$login;?></span></h5>
                                    </center>
                                 </div>
                                 </div>
                                 <div class="card card-accent-theme">
                                   <div class="card-body">
                                    <div class="row">
                                    	<div class="col-lg-5">
                                    		<div>
                                    		<h5 class="text-theme">Пополнение</h5>
                                    		<form action="#" method="post" class="form-horizontal">
                                       
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" id="deposit_size"  class="form-control" placeholder="Сумма платежа">
                                                    <span class="input-group-btn">
                                                        <button type="button" onclick="deposit()"class="btn btn-theme">Далее</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                        	function deposit() {
 $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {
$('#depositButton').html('<div class="loader" style="height:23px;width:23px"></div>');  
$("#error_deposit").hide();
                    },  
                                                                                data: {
                                                                                    type: "deposit",
           sum: $("#deposit_size").val(),                                          
                                 
                                 system: $("#systemdep").val()
                                
           },
                                        success: function(data) {
                                            var obj = data;
                                            if (obj.success == "success") {
               
            
    								window.location.href = obj.link;           
                                       
                                            }else{
                 $('#depositButton').html('Далее');                              
                $("#error_deposit").show();                               
                  toastr["error"](obj.error)
                                            }
                                        }   
   });						
					}
                                        </script>
                                        	<div class="table-responsive">
				<table class="table table-bordered  ">
  <thead>
    <tr>
      <th scope="col">Дата</th>
      <th scope="col">Сумма</th>
    </tr>
  </thead>
  <tbody>
  	<? 
  	$sel_d = mysql_query("SELECT * FROM payments WHERE user_id='$user_id' and status=2 ORDER BY id DESC LIMIT 20");
  	while($row_d = mysql_fetch_array($sel_d)){
  		$data_d = $row_d['data'];
  		$sum_d = $row_d['suma'];
  		echo'<tr><td>'.$data_d.'</td><td>'.$sum_d.'<i class="fa fa-rub"></i></td></tr>';
  	}
  	?>
    
    
  </tbody>
</table>
			</div>
                                    </form>
                                    		</div>
                                    		<hr>
                                    		
                                    			<div>
                                    				
                                    		<h5 class="text-theme">Вывод средств</h5>
                                    		<form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
										
										
										<div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="select">Система</label>
                                            <div class="col-md-9">
                                                <select id="withdrawSelect" name="select" class="form-control">
                                                    <option value="qiwi">QIWI</option>
                                                    <option value="payeer">PAYEER</option>
                                                    <option value="yandex">YANDEX</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Кошелек</label>
                                            <div class="col-md-9">
                                                <input type="text" id="walq" name="text-input" class="form-control" placeholder="Кошелек">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Сумма</label>
                                            <div class="col-md-9">
                                                <input type="text" id="withdraw-money" name="email-input" class="form-control" placeholder="Сумма вывода">
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        	<div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-btn w-100">
                                                        <button type="button" onclick="withdraw()" class="w-100 btn btn-theme">Вывод</button>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <script>
                                        	
function withdraw() {
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {

                    },  
                                                                                data: {
                                                                                    type: "withdraw",
           system: $('#withdrawSelect').val(),
           wallet: $('#walq').val(),                                        sum: $('#withdraw-money').val()                                   
           },
                                        success: function(data) {
                                            var obj = data;
                                            if (obj.success == "success") {
                                            	toastr["success"]('Заяка на вывод добавлена!')
   
                                              $('#balance').html(obj.new_balance);
										
                                                
                                              $("#withdraws").load("profile.php #withdraws");   
                                            }else{
                	 toastr["error"](obj.error)
                                            }
                                        }   
   });
}
               
               
               function back(iddel) {
  $.ajax({
                                                                                type: 'POST',
                                                                                url: '../action.php',
beforeSend: function() {

                    },  
                                                                                data: {
                                                                                    type: "deletewithdraw",
           del: iddel
                                           
           },
                                        success: function(data) {
                                            var obj = data;
                                            
                                            if (obj.success == "success") {
                   	toastr["success"]('Заявка отменена!')
                     
                              
                    $("#withdraws").load("profile.php #withdraws");   
                                                                  
                
                                              $('#balance').html(obj.new_balance);
										 $('#mobbalance').html(obj.new_balance);    
                                                               
                                            }else{
              toastr["error"](obj.error)
               
                                            }
                                        } 
                                        
   });
}


                                        </script>
                                        
                                        <div id="withdraws" class="table-responsive" >
				<table class="table table-bordered ">
  <thead>
    <tr>
      <th scope="col">Дата</th>
      <th scope="col">Сумма</th>
      <th scope="col">Кошелек</th>
      <th scope="col">Статус</th>
    </tr>
  </thead>
  <tbody>
  	<? 
  	$sel_w = mysql_query("SELECT * FROM withdraws WHERE user_id='$user_id' ORDER BY id DESC LIMIT 20");
  	while($row_w = mysql_fetch_array($sel_w)){
  		$id_w = $row_w['id'];
  		$data_w = $row_w['date'];
  		$sum_w = $row_w['sum'];
  		$wallet_w = $row_w['wallet'];
  		$status_w = $row_w['status'];
  		if ($status_w == 1){
  			$status = '<i style="font-size:20px;color:green;box-shadow: 0px 0px 20px -4px green;border-radius:100%;"class="fa fa-check "></i>';
  		}
  		if ($status_w == 2){
  				$status = '<i style="font-size:20px;color:red;box-shadow: 0px 0px 20px -4px red;border-radius:100%;"class="fa fa-times "></i>';
  	
  		}
  		if ($status_w == 0){
  				$status = '<i style="font-size:20px;color:orange;box-shadow: 0px 0px 20px -4px orange;border-radius:100%;"class="fa fa-clock-o "></i><i class="fa fa-times" style="font-size:20px;color:red;box-shadow: 0px 0px 20px -4px red;border-radius:100%; margin-left:5px; cursor:pointer" onclick="back('.$id_w.')"></i>';
  	
  		}
  		echo'<tr><td>'.$data_w.'</td><td>'.$sum_w.' <i class="fa fa-rub"></i></td><td>'.$wallet_w.'</td><td style="text-align:center;">'.$status.'</td></tr>';
  	}
  	?>
    
    
  </tbody>
</table>
			</div>
                                    </form>
                                    		</div>
                                    		
                                    		
                                    	</div>
                                    	<div class="col-lg"></div>
                                    	<div class="col-lg-5">
                                    		
                                    	
                                    			<div>
                                    		<h5 class="text-theme">Рефералы</h5>
                                    		<form action="#" method="post" class="form-horizontal">
                                       
                                        <div class="form-group row">
                                        	
                                            <div class="col-md-12">
                                            	  <label>Ваш реферальный код</label>
                                                <div class="input-group">
                                                	
                                                    <input type="text" id="user_ref_input" onclick="refcopy()" readonly value="<?=$ref_code?>"  class="form-control" placeholder="<?=$ref_code?>">
                                                    <span class="input-group-btn">
                                                        <button type="button" onclick="refcopy()"  class="btn btn-theme">Скопировать</button>
                                                    </span>
                                                </div>
                                                <label>Активация реф.кода</label>
                                                <div class="input-group">
                                                	
                                                    <input type="text" id="ref_active"  value=""  class="form-control" placeholder="Введите код..">
                                                    <span class="input-group-btn">
                                                        <button type="button" onclick="activeRefs()" class="btn btn-theme">Активировать</button>
                                                    </span>
                                                </div>
                                                 <div class="mb-2 mt-2 text-muted text-center">Получайте 10% сразу на баланс с каждого пополнения
                            реферала.</div>
                            
                             <div class="table-responsive">
                    <table class="table table-bordered  " id="refs">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Пользователь</th>
                            <th scope="col">Прибыль </th>
                        </tr>
                    </thead>
                  
                    <tbody id="user_ref_list">
                      <?php 
                      $refs = "SELECT * FROM users WHERE ref_id = '$user_id' ORDER BY id DESC";
$all_refs = mysql_query($refs);
while($row = mysql_fetch_array($all_refs)) {
 
$id = $row['id'];
$login = $row['vk_name'];
$sql_select2 = "SELECT SUM(suma) FROM payments WHERE user_id = '$id' and status=2";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$dohod = $row['SUM(suma)'] / 100 * 10;
}
if($dohod == '') {
  $dohod = 0;
}
echo '<tr><td>'.$id.'</td><td>'.$login.'</td><td id="sums">'.$dohod.'</td></tr>';

  }
?>

                    </tbody>
                </table></div>
                <script>
                                        	function activeRefs() {
    $.ajax({
        type: 'POST',
        url: '../action.php',
        data: {
            type: "activeRefs",
            code: $('#ref_active').val(),
        },
        success: function(data) {
            var obj = data;
            if (obj.success == 'success') {
                $('#balance').html(obj.newbalance);
				$('#mobbalance').html(obj.newbalance);    
                toastr["success"]("Вы активировали код <b>" + obj.code + "</b><br>На баланс зачислено <b>" + parseFloat(obj.amount).toFixed(2) + " <i class='fas fa-coins'></i></b>")
            } else {
                toastr["error"](obj.mess)
            }
        }
    });
}
                                        </script>
                                            </div>
                                        </div>
                            <script>
	                            function refcopy(){
	                        		var copyText = document.getElementById("user_ref_input");
									copyText.select();
		                            document.execCommand("copy");
	                              toastr["success"]("Промокод скопирован!");
	                            }
                        	</script>
                                    </form>
                                    		</div>
                                    		<hr>
                                    		
                                    		
                                    	</div>
                                    </div>

                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->





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
