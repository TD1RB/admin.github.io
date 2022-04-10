<?php
session_start();
require("config.php");

$sid = $_SESSION['hash'];
$hash = $sid;

if($hash){
    $sql_select1 = "SELECT * FROM users WHERE hash='$sid'";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{

    $user_id = $row['id'];
    $balance = $row['balance'];
    $img = $row['img'];
    $login = $row['vk_name'];
    $id = $row['id'];
   $adm = $row['admin'];
      
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>TreshMoney</title>

    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/manifest.json">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <!-- fonts -->
    <link rel="stylesheet" href="fonts/md-fonts/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="libs/animate.css/animate.min.css">

     <!-- jquery-loading -->
     <link rel="stylesheet" href="libs/jquery-loading/dist/jquery.loading.min.css">
    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

    <section class="container-server-errors">

        <div class="brand-logo-dark float-left ">
            <a class="" href="#">
                <Strong><?=$sitename;?></Strong>
            </a>
        </div>

        <div class="server-errors pages-card">
            <div class="status-text-1">Oops!</div>
            <div class="text-center status-text-2 mt-4 text-dark">Вы заблокированы! </div>
            <div class=" text-center ">
                <b>Ваш ID: <?=$user_id;?></b>
            </div>
            <div class="text-center">
                <a href="<?=$group;?>" class="btn  btn-theme login-btn text-white">Группа вк</a>
            </div>

        </div>
        <!-- end server-error pages -->
    </section>
    <!-- end secton container -->

    <div class="d-none d-lg-block half-circle"></div>
    <div class="small-circle"></div>
    <div class="d-none d-lg-block half-circle-bottom"></div>
    <div class="small-circle-bottom"></div>

   
    <!-- end mybutton -->

    


    <!-- Bootstrap and necessary plugins -->
    <script src="libs/jquery/dist/jquery.min.js"></script>
    <script src="libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/bootstrap/bootstrap.min.js"></script>
    <script src="libs/PACE/pace.min.js"></script>
    <script src="libs/chart.js/dist/Chart.min.js"></script>
    <script src="libs/nicescroll/jquery.nicescroll.min.js"></script>

    <script src="libs/jquery-knob/dist/jquery.knob.min.js"></script>


    <!-- jquery-loading -->
    <script src="libs/jquery-loading/dist/jquery.loading.min.js"></script>
    <!-- octadmin Main Script -->
    <script src="js/app.js"></script>

</body>

</html>