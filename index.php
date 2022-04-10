<?php
require('components/header.php');
?>
   <!-- слил данный скрипт - https://vk.com/dikiy_edits -->
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

                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi mdi-crown"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">Jackpot</h5>

                                    <div class="text-center btn-tool-bar">
                                        <button onclick="location.href='jackpot'" class="btn btn-theme ">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end ecom-widget-sales -->
                        </div>
                        <!-- end col -->
                        <div class="col-md-3 ">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">
                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi  mdi-bomb"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">Mines</h5>



                                    <div class="text-center btn-tool-bar">
                                        <button onclick="location.href='mines'"class="btn btn-theme ">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- ecom-widget-sales -->
                        </div>

                        <div class="col-md-3 ">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">
                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi  mdi-dice-5"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">Dice</h5>



                                    <div class="text-center btn-tool-bar">
                                        <button onclick="location.href='dice'"class="btn btn-theme ">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- ecom-widget-sales -->
                        </div>
                        <!-- end col -->

                        

                        <div class="col-md-3 ">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">

                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi mdi-chart-bubble"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">Bubbles</h5>


                                    <div class="text-center btn-tool-bar">
                                        <button  onclick="location.href='bubbles'" class="btn btn-theme ">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end  ecom-widget-sales -->
                        </div>

                        <div class="col-md-3 ">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">

                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi mdi-cards"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">BlackJack</h5>


                                    <div class="text-center btn-tool-bar">
                                        <button onclick="location.href='blackjack'" class="btn btn-theme ">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end  ecom-widget-sales -->
                        </div>

                        <div class="col-md-3 ">
                            <div class="card ecom-widget-sales">
                                <div class="card-body">

                                    <div class="ecom-sales-icon text-center">
                                        <i class="mdi  mdi-checkbox-blank-circle-outline"></i>
                                    </div>
                                    <!-- end ecom-sales-icon -->
                                    <h5 class="text-center">Wheel</h5>


                                    <div class="text-center btn-tool-bar">
                                        <button class="btn btn-theme " onclick="location.href='wheel'">Играть</button>
                                    </div>
                                    <!-- end btn-tool-bar -->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end  ecom-widget-sales -->
                        </div>


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
