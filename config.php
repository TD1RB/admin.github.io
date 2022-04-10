<?php

session_start();
if($_GET['d'] == 1){
	$_SESSION['get'] = 1;
}

$sid = $_SESSION['hash'];
$hash = $sid;
$bd_login = 'co29829_p09275';//логин базы данных
$bd_pass = 'ZG5bjfA9';//пароль базы данных
$bd_name = 'co29829_p09275';
 
mysql_connect("localhost", $bd_login, $bd_pass)//параметры в скобках ("хост", "имя пользователя", "пароль")
or die("<p>Ошибка подключения к базе данных! " . mysql_error() . "</p>");
mysql_select_db($bd_name)//параметр в скобках ("имя базы, с которой соединяемся")
 or die("<p>Ошибка выбора базы данных! ". mysql_error() . "</p>");
mysql_query("SET NAMES utf8");
if($a != 1){
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
      
$ban = $row['ban'];
}


}
}

$commission = 6; // комиссия при выводе



$sql_select1 = "SELECT * FROM config";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{
$amount_ref = $row['amount_ref'];
$sitename = $row['sitename'];
$sitedomen = $row['sitedomen'];
$group = $row['sitegroup']; // группа сайта
$site_support = $row['sitesupport'];
$linksite = $_SERVER['HTTP_HOST']; // ссылка на сайт
$sitekey = $row['sitekey']; // ключ сайта для каптчи
$mail = $row['sitemail']; // почта сайта
$min_bonus_s = $row['min_bonus_size']; // минимальная сумма бонуса в раздаче (в руб)
$max_bonus_s = $row['max_bonus_size']; // максимальная сумма бонуса в раздаче (в руб)
$min_withdraw = $row['min_withdraw_sum']; // минимальная сумма вывода
$bonus_reg = $row['bonus_reg'];
$dep_withdraw = $row['dep_withdraw'];; // деп при выводе
$fk_id = $row['fk_id'];
$fk_secret_1 = $row['fk_secret_1'];
$fk_secret_2 = $row['fk_secret_2'];

$min_bet = $row['min_bet'];
$max_bet = $row['max_bet'];
$min_per = $row['min_per'];
$max_per = $row['max_per'];
$online_fake = $row['fake_online'];
$fake_interval = $row['fake_interval'];
$min_sum_dep = $row['min_sum_dep'];
$idvk = $row['id_vk'];
$tokenvk = $row['token_vk'];
}
?>