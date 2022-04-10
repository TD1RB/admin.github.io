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
                                     <h4 class="text-theme">Последние выводы</h4>
                                    
                                    <div class="table-responsive">
                 <table class="table  table-bordered" id="all_w">
                      
                        <thead>
                            <tr>
                               
                               
                                <th scope="col">Сумма</th>
                                <th scope="col">Кошелёк</th>
                                <th scope="col">Дата</th>
                            </tr>

                        </thead>
                        <tbody>
                           <?php
                           
$withdraws_list = "SELECT * FROM withdraws WHERE status = '1' ORDER BY id DESC LIMIT 20";
$all_withdraws_list = mysql_query($withdraws_list);
while($row = mysql_fetch_array($all_withdraws_list)) {
 
$id = $row['id'];
$sum = $row['sum'];
$ps = $row['ps'];
$wallet = $row['wallet'];
$status = $row['status'];
$date = $row['date'];
$date = substr($date,0,-3);
$wallet_not_full = substr($wallet,0,-4);
if($status == 1) {
  $span = "badge-success";
  $text = "Отправлено";
  $dffd = "";
}

echo '<tr><td>'.$sum.' руб.</td><td>'.$wallet_not_full.'****</td><td>'.$date.'</td></tr>';

  }
?>

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
