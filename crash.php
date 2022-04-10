<?php
require('components/header.php');
$_SESSION['crash'] = 0;
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
               <div class="col-lg-8" style="text-align:center;">
                                <div id="chart" style="min-height: 395px;"></div>
<h1 style="position:relative;z-index:44;bottom:50%;color:#fff">x<span id="crash_x">0</span></h1>
                           </div>
                           <div class="col-lg">
                          
                           <div class="bets-tbl" id="betsss">
                               <div class="amount-bomb ">
                                    <div class="content">
                                      
                                    <div class="card-body">
                                    	
		<form>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Сумма ставки</label>
                                      <input type="number" class="form-control" id="inputBetAmount" aria-describedby="emailHelp">
                                    </div>
                                    
                                  </form>

                                    <div class="text-center btn-tool-bar">
                                    	 <button onclick="start_crash()" id="startcrash" class="btn btn-theme w-100" data-btn="game">Играть</button>
            								<button onclick="take()" id="takecrash" class="btn btn-theme w-100" style="display:none"data-btn="game" >Забрать 0.00</button>
            							
                                      </div>
                                      
         	 
                                    
                                    <!-- end btn-tool-bar -->
                                </div>
                   
                   
                                    
                                    


</div>
</div>

                                  
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h4 class="text-theme">История игр</h4>
                                    <br/>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Игра</th>
                                                    <th>Пользователь</th>
                                                    <th>Ставка</th>
                                                    <th>Выигрыш</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Mines</td>
                                                    <td>Александр Скриптеров</td>
                                                    <td>1.00</td>
                                                    <td>
                                                        <span class="text-danger">0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Mines</td>
                                                    <td>Александр Скриптеров</td>
                                                    <td>1.00</td>
                                                    <td>
                                                        <span class="text-success">5.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Mines</td>
                                                    <td>Александр Скриптеров</td>
                                                    <td>1.00</td>
                                                    <td>
                                                        <span class="text-danger">0.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Mines</td>
                                                    <td>Александр Скриптеров</td>
                                                    <td>1.00</td>
                                                    <td>
                                                        <span class="text-danger">0.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
    <script src="libs/Bootstrap/bootstrap.min.js"></script>
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

 <script src="Chart.js"></script>
 <script src="daterangepicker.js"></script>
 <script src="apexcharts.js"></script>
 <script src="moment.js"></script>
<link rel="stylesheet" href="apexcharts.css">
        <!-- datatable examples -->
        <script src="js/table-datatable-example.js"></script>
    <!-- dashboard-ecom script -->
    <script src="js/dashboard-ecom-widgets.js"></script>
    <script src="libs/toastr/toastr.min.js"></script>
<script src="js/toastr-example.js"></script>
 <script src="https://gamewin.space/js/odometer.js"></script>

<style>
	.apexcharts-toolbar{
		display:none;
	}
</style>
<script type="text/javascript">
                            
                         
                            
                            
                            
                            
	
function start_crash(){
	$('#startcrash').attr("disabled", "disabled");
	$.ajax({
	type: 'POST',
	url: 'action.php',
	beforeSend: function () {},
	data: {
		type: "startcrash",
		bet: $('#inputBetAmount').val()
	},
	success: function (data) {
		var obj = (data);
		if (obj.success == "success") {
				$('#startcrash').hide();
				$('#takecrash').show();
				$('#balance').html(obj.new_balance);
				go_crash();
		} else {
			toastr["error"](obj.error)
				$('#startcrash').removeAttr("disabled", "disabled");
		}
	}
});
                                    

	
	
}


function go_crash(){
	

		var doo = 1;
	var i = 0;
	let timerId = setInterval(function() {
	
	$.ajax({
	type: 'POST',
	url: 'action.php',
	beforeSend: function () {},
	data: {
		type: "get_x_crash",
	},
	success: function (data) {
		var obj = (data);
		if (obj.success == "success") {
			x = obj.x;
				$('#crash_x').html(x.toFixed(2));
				chart.updateSeries([{
                                                name: 'Заработок',
                                                data: obj.chart
                                             }])
			if(obj.crash == 1){
				$('#startcrash').show();
					$('#startcrash').removeAttr("disabled", "disabled");
				$('#takecrash').hide();
				clearInterval(timerId);
			}
				
		} else {
			toastr["error"](obj.error)
			
		}
	}
});



	if (0 == 1){
		clearInterval(timerId);
		cb(0, 0)
	}
	}, 500);
	
}
 function cb(start, end) {
                                   
                                     $.ajax({
                                        type: 'POST',
                                        url: 'action.php',
                                        beforeSend: function () {

                                        },
                                        data: {
                                            type: "getRefEarn",
                                            a: end
                                        },
                                        success: function (data) {
                                        var obj = (data);
                                        $("#startEarn").html();
                                        $("#endEarn").html();
                                        $("#earnRange").html(obj.er);
                                            chart.updateSeries([{
                                                name: 'Заработок',
                                                data: obj.chart
                                             }])
                                             
                                         $(".apexcharts-toolbar").remove()
                                        }
                                    });
                                }
                                
                            $(function() {
                                

                                function cb(start, end) {
                                   
                                     $.ajax({
                                        type: 'POST',
                                        url: 'action.php',
                                        beforeSend: function () {

                                        },
                                        data: {
                                            type: "getRefEarn",
                                            
                                        },
                                        success: function (data) {
                                        var obj = (data);
                                       
                                            chart.updateSeries([{
                                                name: 'Заработок',
                                                data: obj.chart
                                             }])
                                             
                                         $(".apexcharts-toolbar").remove()
                                        }
                                    });
                                }
                               

                                cb(0, 0);

                            });
                            
                          

                        </script>





                        <script>

                            var options = {
                                            title: {
                                                text: "",
                                                align: 'left',
                                                margin: 10,
                                                offsetX: 0,
                                                offsetY: 0,
                                                floating: false,
                                                style: {
                                                    fontSize: '16px',
                                                    color: '#263238'
                                                },
                                            },
                                            stroke: {
                                                curve: 'straight'
                                            },
                                            markers: {
                                                size: 0,
                                            },
                                            toolbar: {
                                                show: false

                                            },
                                            
                                            colors: ['#0168fa', '#0168fa', '#0168fa'],
                                            chart: {
                                                height: 380,
                                                type: "area"
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: "Новых рефералов",
                                                data: []
                                            }],
                                            noData: {
                                                text: 'Загрузка...'
                                              },

                                            fill: {

                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.6,
                                                    opacityTo: 0.9

                                                }
                                            },
                                            tooltip: {
                                                enabled: false,

                                            },

                                            xaxis: {
                                                tooltip: {
                                                    enabled: false
                                                },
                                                categories: []
                                            }
                                        };

                                        var chart = new ApexCharts(document.querySelector("#chart"), options);

                                        chart.render();
                            
                            
                            
                                    </script>
</body>

<script>
		$(window).on('load', function () {
			 $('#balance').attr('balance', <?=$balance?>);
		  });
	</script>

</html>

