<?php

/// Конец
 session_start();
 $sid = $_SESSION['hash'];
require("config.php");

header('Content-Type: application/json; charset=utf-8');

$data = date("d.m.Y");
$type = $_POST['type'];
$error = 0;
$fa = "";
if (!$sid){
	$error = 1;
	$mess = "Авторизуйтесь";
	$fa = "error";
	
	exit();
}
if($type == "activeRefs")
{
$code = $_POST['code'];

$sql_select = "SELECT * FROM users WHERE hash='$hash'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$balance = $row['balance'];
$user_id = $row['id'];
$refBy = $row['ref_id'];
$wager = $row['wager'];
$rCode = $row['ref_code'];
$name = $row['vk_name'];
}
$check = 1;
if($code == " "){
  $error = 1;
  $fa = "error";
  $mess = "Код не может быть пустым!";
  $check = 0;	
}
if (!preg_match("/^[0-9a-zA-Z]+$/",$code)){
  $error = 2;
  $fa = "error";
  $mess = "Некорректный код!";
  $check = 0;	
}
if (!preg_match('/^\S.*\S$/',$code)){
  $error = 3;
  $fa = "error";
  $mess = "Некорректный код!";
  $check = 0;		
}
if($code == $rCode){
  $error = 4;
  $fa = "error";
  $mess = "Вы не можете активировать свой код!";
  $check = 0;	
}
if($_SESSION['timestamp'] + 2 > time()){ 
  $error = 5;
  $fa = "error";
  $mess = "Пожалуйста, подождите...";
} 
else{
  $_SESSION['timestamp'] = time();
}
if($refBy != 0){
  $error = 6;
  $fa = "error";
  $mess = "Вы уже являетесь рефералом!";
}
if($check == 1){
$sql_select = "SELECT * FROM users WHERE ref_code='$code'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
$idRef = $row['id'];
if(!$row)
{	
  $error = 7;
  $fa = "error";
  $mess = "Введеного Вами кода не существует!";
}
}

if($error == 0)
{
$amount = $amount_ref;
	
$sql_update = "UPDATE users SET balance = balance + '$amount', ref_id = '$idRef' WHERE hash='$hash'";
$result = mysql_query($sql_update);


$sql_select = "SELECT * FROM users WHERE hash='$hash'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
$balancenew = $row['balance'];
$fa = "success";
}
// массив для ответа
$res = array(
	'success' => "$fa",
	'mess' => "$mess",
	'amount' => "$amount",
	'newbalance' => "$balancenew",
	'code' => "$code",
    );
}
if($type == "bubble") {
 // $winsum = $_POST['win'];
  
  $sum = $_POST['sum'];
  $per = $_POST['per'];
   $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{ 
$balance = $row['balance'];
$ban = $row['ban'];
$sliv = $row['sliv'];
$fart = $row['win'];
$login = $row['vk_name'];
$user_id = $row['id'];
}
if(!$sid) {
    $error = 1;
    $mess = "Авторизуйтесь";
    $fa = "error";
} else {
  if($per < 2 || $per > 10000 || !is_numeric($per)) {
    $error = 1;
    $mess = "Коэффицент от 2 до 10000";
    $fa = "error";
  }
  if($sum > $balance) {
    $error = 1;
    $mess = "Недостаточно средств";
    $fa = "error";
  }
  if($sum < 1 || $sum > 1500 || !is_numeric($sum)) {
    $error = 1;
    $mess = "Сумма от 1 до 1500";
    $fa = "error";
  }
  if($error == 0) {
    /*
    $list = [];
    if($per <= 5) {
      $mi = 10;
    } elseif ($per <= 10) {
      $mi = 7;
    } elseif ($per <= 15) {
      $mi = 5;
    } elseif ($per > 15) {
      $mi = 4;
    }
    $micoeff = [];
    for($i=0;$i<=20;$i++) {$micoeff[]+=rand(1, $per * 3);}
    for($i=0;$i<=20;$i++) {$list[]+=rand(1, $per * $micoeff[rand(0, count($micoeff)-1)]) * 10;}
    $coef = round($list[rand(0, count($list)-1)] / 1000, 2);
    
    
   if($per <= 10) {
    $nwin = 1000000 - $per * 100000;
  } elseif($per <= 100 && $per > 10) {
    $nwin = 1000000 - $per * 10000;
  } elseif($per <= 1000 && $per > 100) {
    $nwin = 1000000 - $per * 1000;
  } elseif($per <= 10000 && $per > 1000) {
    $nwin = 1000000 - $per * 100;
  }*/
  $rand = rand(0, 999999);
  $nwin_g = 100 / $per;
  $nwin = 1000000 - ($nwin_g * 10000);
  if($rand >= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
          $coef = rand($per * 100, $per * 300.5) / 100;
$www = $sum * $per;
          $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
    VALUES ('BUBBLES', '$user_id', '$login', '', '', '$sum', '', 'win', '$www');";
mysql_query($insert_sql1);


  $insert_sql1 = "INSERT INTO `games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`, `gtype`) 
  VALUES ('NULL', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$coef', 'win', '0', 'bubbles');";
mysql_query($insert_sql1);
  $newbalance = round($balance + $sum * $per - $sum, 2);
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $fa = "success";
  }
         if($rand < $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
    if($per < 10){
    $rr = rand(1, $per);
}else{
    
        $rr = rand(1, 10);

}
      $coef = rand(10, $rr * 100) / 100;
//   $insert_sql1 = "INSERT INTO `games` (`id`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`, `gtype`) 
//   VALUES ('NULL', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$coef', 'lose', '0', 'bubbles');";
// mysql_query($insert_sql1);

     $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
    VALUES ('BUBBLES', '$user_id', '$login', '', '', '$sum', '', 'lose', '0');";
mysql_query($insert_sql1);



  $newbalance = $balance - $sum;
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $error = 1;
  $mess = "Выпало <b>$coef</b>";
  $fa = "error";
  }
    $hash = hash('sha512', $coef);
    $hashEdit = "yes";
      $mess = "Коэффицент <b>$coef х</b>";
  } else {
    $newbalance = $balance;
  }
}
  $winning = number_format($newbalance, 2, '.', ' ');
  $res = array(
  'success' => "$fa",
  'error' => "$mess",
  'number' => "$coef",
    'hash' => "$hash",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance",
    'mid' => "$sid",
    'mal' => "$balance",
    'hashEdit' => "$hashEdit",
    'rnd' => "$rand",
    'nw' => "$nwin"

    );
}

if($type == "sitecount") {
      $sql_select = "SELECT COUNT(*) FROM messages";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
$count = $row['COUNT(*)'];

$time = time() + 5;
$update_sql111 = "Update users set online='1', online_time='$time' WHERE hash='$sid'";
    mysql_query($update_sql111) or die("" . mysql_error());
    
    
$sql_select = "SELECT online_time, id FROM users";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
do
{
 $time = time();
 if($time > $row['online_time'])
 {
$update_sql1 = "Update users set online='0' WHERE id=".$row['id'];
mysql_query($update_sql1) or die("" . mysql_error());
 }
}
while($row = mysql_fetch_array($result));

$sql_select = "SELECT COUNT(*) FROM users WHERE online='1'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);

$online_default = $row['COUNT(*)'];
$online = rand(10, 15);



    $res = array(
        'online' => "$online",
    'count' => "$count", 


    );

}

if($type == "keno") {
$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{   
	$user_id = $row['id'];
	$login = $row['vk_name'];
$balance = $row['balance'];
$lastbet = $row['lastbet'];
}
$fatal = 0;
$time = time();
$f_time = $time - $lastbet;
echo header('Content-Type: application/json');
$sum = $_POST['bet'];
if (!is_array($_POST['select'])) { // преобразуем в массив
        $click = array();
    } else {
        $click = $_POST['select'];
    }
    
    $test = $click;
$elCounts = array_count_values($test);
$result = array();

for ($i = 0; $i < count($test); ++$i) {
    foreach ($elCounts as $k => $v) {
        if ($test[$i] == $k && $v == 1) {
            $result[] = $test[$i];
            break;
        }
    }
}

$click = $result;
    
// Проверяем все значения массива, is_numeric ли они
if (is_array($click)){
        foreach ($click as $val){
            if (is_numeric($val)){ // всё хорошо, айди корректное
               
            } else {
            	
                $fatal++;
             }
        }
    }
if(empty($sid)) {
    $error = 999;
    $status = "error";
    $mess = "Необходимо авторизоваться!";
} else {
if($click == 'null') {
    $error = 1;
    $status = "error";
    $mess = "Выберите от 1 до 10 ячеек!";
}

if((count($_POST['select']) > 10) or (count($_POST['select']) < 1)) {
    $error = 1;
    $status = "error";
    $mess = "Выберите от 1 до 10 ячеек!";
}

if($sum == '') {
    $error = 2;
    $status = "error";
    $mess = "Введите сумму ставки";
}
if($sum < 1 && $sum != '') {
    $error = 3;
    $status = "error";
    $mess = "Минимальная ставка 1Р";
}
if(!is_numeric($sum) && !empty($sum)) {
    $error = 4;
    $status = "error";
    $mess = "Сумма введена некорректно";
}
if(!is_array($click)) {
    $error = 5;
    $status = "error";
    $mess = "Error (!is_array)";
}
if(count($_POST['select']) > 10) {
    $error = 6;
    $status = "error";
    $mess = "Error (is_active > 10)";
}
if(max($click) > 40) {
    $error = 7;
    $status = "error";
    $mess = "Max value of id is 40";
}
if(min($click) < 1 && !empty($_POST['select'])) {
    $error = 7;
    $status = "error";
    $mess = "Min value of id is 1";
}
if($fatal > 0) {
    $error = 8;
    $status = "error";
    $mess = "Ячейка не может иметь такой ID";
}
if($sum > $balance) {
    $error = 9;
    $status = "error";
    $mess = "Недостаточно средств";
}
if (strpos($sum, '.') == true) {
    $error = 10;
    $status = "error";
    $mess = "Ставка только целыми числами";
}
if($f_time < 1) { // если ставка чаще чем раз в 1 секунды
    $error = 11;
    $status = "error";
    $mess = "Слишком частые ставки!";
}

}
if($error == 0) {
if (count($_POST['select']) == 1){
	$coef = array(0, 3.8); // коэффиценты 
}
if (count($_POST['select']) == 2){
	$coef = array(0, 1.7, 5.2); // коэффиценты 
}
if (count($_POST['select']) == 3){
	$coef = array(0, 0, 2.7, 48); // коэффиценты 
}
if (count($_POST['select']) == 4){
	$coef = array(0, 0, 1.7, 10, 84); // коэффиценты 
}
if (count($_POST['select']) == 5){
	$coef = array(0, 0, 1.4, 4, 14, 290); // коэффиценты 
}
if (count($_POST['select']) == 6){
	$coef = array(0, 0, 0, 3, 9, 160, 720); // коэффиценты 
}
if (count($_POST['select']) == 7){
	$coef = array(0, 0, 0, 2, 7, 30, 280, 800); // коэффиценты 
}
if (count($_POST['select']) == 8){
	$coef = array(0, 0, 0, 2, 4, 10, 50, 300, 850); // коэффиценты 
}
if (count($_POST['select']) == 9){
	$coef = array(0, 0, 0, 2, 2.5, 4.5, 12, 60, 320, 900); // коэффиценты 
}
if (count($_POST['select']) == 10){
	$coef = array(0, 0, 0, 1.5, 2, 4, 6, 22, 80, 400, 1000); // коэффиценты 
}



$step = 0;
$win_value = [];
for ($i=1;$i<=40;$i++) {
    $m[]=$i;
}
shuffle($m);
$arr = []; // массив с числами которые выпали
//$click = array(5, 6, 9, 8, 11, 7, 4, 17, 21, 18);
for($i=0; $i<10; $i++) { // добавляем в массив числа
array_push($arr, $m[$i]);
}
for($i=0; $i<11; $i++) { // сверяем выигрышные значения

if(in_array($click[$i], $arr)) {
$step++;
array_push($win_value, $click[$i]);
} else {
    $step = $step;
}
}
$coef1 = $coef;
$in_array = $step;
$coef = $coef1[$step]; // получаем итоговый коэф
// echo json_encode($coef1);
$win_value_encode = json_encode($win_value);
$drop_value_encode = json_encode($arr);
$upd_time = mysql_query("UPDATE users SET lastbet = '$time' WHERE hash = '$sid'");
if($coef == 0) { // если коэф нулевой - отнимаем ставку
$upd_balance = round($balance - $sum, 2);

$winsumm = 0;
$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('KENO', '$user_id', '$login', '', '', '$sum', '', 'lose', '$winsumm');";
mysql_query($insert_sql1);
$upd = mysql_query("UPDATE users SET balance = '$upd_balance' WHERE hash = '$sid'"); // Обновляем баланс 
} else {
$upd_balance = round($balance + ($sum * $coef) - $sum, 2);

$winsumm = ($sum * $coef);
$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('KENO', '$user_id', '$login', '', '', '$sum', '', 'win', '$winsumm');";
mysql_query($insert_sql1);


$upd = mysql_query("UPDATE users SET balance = '$upd_balance' WHERE hash = '$sid'"); // Обновляем баланс 
}
$status = "success"; // всё отлично, передаем инфу о успехе
}
$res = array('fa' => "$status", 'win' => "$win_value_encode", 'drop' => "$drop_value_encode", 'coef' => "$coef", 'error' => "$mess", 'arr' =>  "$click", 'in_array' => "$in_array", 'upd_balance' => "$upd_balance");
}

if($type == "randomCell") {
for ($i=1;$i<=40;$i++) {
    $m[]=$i;
}
shuffle($m);
$arr = []; // массив с числами которые выпали
for($i=0; $i<10; $i++) { // добавляем в массив числа
array_push($arr, $m[$i]);
}
$drop_value_encode = json_encode($arr);
$status = "success";
$res = array('fa' => "$status", 'drop' => "$drop_value_encode");
}



if($type == 'play_wheel'){
	
	$query = ("SELECT * FROM `users` WHERE `hash`='$sid'");
                $result10 = mysql_query($query);
                $row10 = mysql_fetch_array($result10);
                if($row10){
                	$login = $row10['vk_name'];
                    $money = $row10['balance'];
                      }
                
                
    $bet = $_POST['bet'];
    $mode = $_POST['mode'];

    if($mode == 'easy' || $mode == 'medium' || $mode == 'hard'){
    if($bet >= 1){
        if($bet <= $money){

            if($hash){
                $query = ("SELECT * FROM `users` WHERE `hash`='$sid'");
                $result10 = mysql_query($query);
                $row10 = mysql_fetch_array($result10);
                if($row10){
                    $ref_ref_money = $row10['ref_money'];
                    $ref_money_money = $row10['money'];
                    $amount_prize = $bet * $referalka;
                    $query = mysql_query( "UPDATE `users` SET `ref_money` = '$ref_ref_money'+'$amount_prize',`money`='$ref_money_money'+'$amount_prize' WHERE `id` = '$invited'");
                }
            }

            if($mode == 'easy'){
                $coef = [1.2,1.2,1.2,0,1.2,1.2,1.2,1.2,0,1.5,1.2,1.2,1.2,0,1.2,1.2,1.2,1.2,0,1.5,1.2,1.2,1.2,0,1.2,1.2,1.2,1.2,0,1.5,1.2,1.2,1.2,0,1.2,1.2,1.2,1.2,0,1.5,1.2,1.2,1.2,0,1.2,1.2,1.2,1.2,0,1.5];
                $rand_win = mt_rand(0,49);

                if($coef[$rand_win] == 0){
                    $key = [1,6,11,16,21,26,31,36,41,46];
                    $xx = mt_rand(0,0);
                }
                if($coef[$rand_win] == 1.2){
                    $key = [2,3,4,5,7,8,9,12,13,14,15,17,18,19,22,23,24,25,27,28,29,32,33,34,35,37,38,39,42,43,44,45,47,48,49];
                    $xx = mt_rand(0,34);
                }
                if($coef[$rand_win] == 1.5){
                    $key = [10,20,30,40,50];
                    $xx = mt_rand(0,4);
                }
            }
            if($mode == 'medium'){
                $coef = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,1.5,2,2,2,2,2,2,2,2,5,3,3,3];
                $rand_win = mt_rand(0,49);

                if($coef[$rand_win] == 0){
                    $key = [1,3,5,7,9,11,13,15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49];
                    $xx = mt_rand(0,24);
                }
                if($coef[$rand_win] == 1.5){
                    $key = [2,4,8,12,18,22,26,30,32,36,40,44,48];
                    $xx = mt_rand(0,12);
                }
                if($coef[$rand_win] == 2){
                    $key = [6,14,16,20,28,38,42,46];
                    $xx = mt_rand(0,7);
                }
                if($coef[$rand_win] == 3){
                    $key = [10,24,34];
                    $xx = mt_rand(0,2);
                }
                if($coef[$rand_win] == 5){
                    $key = [50];
                    $xx = mt_rand(0,0);
                }
            }
            if($mode == 'hard'){
                $coef = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,50];
                $rand_win = mt_rand(0,49);
                if($coef[$rand_win] == 50){
                    $key = [50];
                    $xx = mt_rand(0,0);
                }
                if($coef[$rand_win] == 0){
                    $key = range(1,49);
                    $xx = mt_rand(0,48);
                }
            }
            
            $key = $key[$xx];
            $win_sum = $bet * $coef[$rand_win];
            $win1 = $win_sum - $bet;
            $type = 'win';
            // $winsumm = ($sum * $coef);
            if($win_sum == 0){
            	$type = 'lose';
            }
$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('WHEEL', '$user_id', '$login', '', '', '$bet', '', '$type', '$win_sum');";
mysql_query($insert_sql1);


            $query = mysql_query( "INSERT INTO `wheel` (`id_users`, `bet`, `vipalo`, `win`) VALUES ('$id', '$bet', '$coef[$rand_win]', '$win_sum')");
            $query = mysql_query( "UPDATE `users` SET `balance`='$money'+'$win1' WHERE `hash`='$sid'");
            $query = mysql_query( "INSERT INTO `history` (`games`, `players`, `id_users`, `bet`, `coef`, `win`, `time`, `time1`) VALUES ('wheel','$login', '$id', '$bet', '$coef[$rand_win]', '$win_sum', '$time', '$time1')");
            $money = $money + $win_sum - $bet;
            $obj = array('notification'=>'play','key'=>"$key",'win'=>"$coef[$rand_win]",'win_sum'=>"$win_sum",'money'=>"$money");

        }else{
            $mess = 'Недостаточно средств';
            $obj = array('notification'=>'error','mess'=>"$mess");
        }

    }else{
        $mess = 'Минимальная сумма игры 1 рубль';
        $obj = array('notification'=>'error','mess'=>"$mess");
    }
}else{
    $mess = 'Произошла ошибка';
    $obj = array('notification'=>'error','mess'=>"$mess");
}
$res = $obj;
}
if($type == "get_x_crash"){
	
	
	if($error == 0){
		$fa = 'success';
		$off = 0;
		$_SESSION['crash'] += 0.1;
		
			$chart = array(['x' => 0, 'y' => 0], ['x' => 1, 'y' => $_SESSION['crash']]);
			if ($_SESSION['yes_crash'] <= $_SESSION['crash']){
				$off = 1;
			}
			
	}
	
		$res = array(
'success' => "$fa",
'error' => "$mess",
'x' => $_SESSION['crash'],
'crash' => $off,
'chart' => $chart
    );
    
}

if($type == "startcrash"){
	$bet = $_POST['bet'];
	
	$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $balance = $row['balance'];
	$user_id = $row['id'];
}

if($_SESSION['crash'] > 0){
$error = 1;
	$mess = "Ошибка";
	$fa = "error";	
}
if($bet < 1){
	$error = 1;
	$mess = "Сумма ставки от 1";
	$fa = "error";
}

if(!is_numeric($bet)){
	$error = 1;
	$mess = "Сумма ставки от 1";
	$fa = "error";
}

if($bet > $balance){
	$error = 1;
	$mess = "Недостаточно средств";
	$fa = "error";
}

// $res = mysql_fetch_array(mysql_query("SELECT * FROM crash WHERE user_id=$user_id"));


	if($error == 0){
	
		$_SESSION['crash'] = 0;
		$new_balance = $balance - $bet;
		mysql_query("UPDATE users set balance='$new_balance' WHERE hash='$sid'");
		mysql_query("UPDATE crash set off='2' WHERE user_id='$user_id'");
		$rand_crash = rand(0,5);
		if ($rand_crash <= 2){
			$rand_crash = rand(0, 200) / 100;
		}else if($rand_crash > 2 and $rand_crash < 4){
			$rand_crash = rand(0, 400) / 100;
		}else{
			$rand_crash = rand(0, 1000) / 100;
		}
		
			$_SESSION['yes_crash'] = $rand_crash;
		mysql_query("INSERT INTO crash set user_id='$user_id',bet='$bet',off=1,crash='$rand_crash' ");
		$fa = "success";
	}	
	
	
	$res = array(
'success' => "$fa",
'error' => "$mess",
'new_balance' => "$new_balance"
    );
    
    
}
if ($type == "getRefEarn"){
	$a = $_POST['a'];
	if (!$a){
		$a = 0;
	}
	$x = ($a * 1.3) / 2;
// 	$start = $_POST['start'];
// 	$end = $_POST['end'];
// 	$start = explode("-", $start);
// 	$end = explode("-", $end);
	
// 	$start_d = $start[2].'.'.$start[1].'.'.$start[0];
// 	$end_d = $end[2].'.'.$end[1].'.'.$end[0];
	
// 	$sql_select = "SELECT * FROM kot_user WHERE hash='$sid'";
// $result = mysql_query($sql_select);
// $row = mysql_fetch_array($result);
// if($row)
// {	
// $user_id = $row['id'];
// }
// $refs = array();


$rand = rand(0, 10);
$a = round($a, 2);
	
	$refs = array(['x' => 0, 'y' => 0], ['x' => 1, 'y' => $a]);
	 $res = array(
'chart' => $refs,
'er' => "0"
    );
}


if($type == "fart_j") {
$user_id = $_POST['id_user'];
$res = mysql_fetch_array(mysql_query("SELECT * FROM room_2 WHERE id=$user_id"));

$r = mysql_fetch_array(mysql_query("SELECT MAX(finishjackpot) FROM users"));
$f = $r['MAX(finishjackpot)'];

$time = time();
if ($time < $f){
	$error = 1;
	$mess = "Игра идет";
   $fa = "error";
}


	if ($error == 0){
		$fa = "success";
		$login = $res['login'];
			mysql_query("UPDATE room_2 set fart=0");
		mysql_query("UPDATE room_2 set fart=1 WHERE id=$user_id");
	}
	 $res = array(
'fa' => "$fa",
'error' => "$mess",
'login' => "$login"
    );
	
}
if($type == "coinflip") {
    $sum = $_POST['size'];
    $lay = $_POST['lay'];


$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $startcoin = $row['startcoin'];
$user_id=$row['id'];
}
$sql_select = "SELECT * FROM gamecoin WHERE id_user='$user_id' and off=0";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $caef = $row['caef'];

}

$sql_select = "SELECT * FROM admin ";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$win = $row['win'];
$lose = $row['lose'];
}
$lose = 1;
$win = 0;

if($startcoin != 1) {
    $error = 6;
    $mess = "Ошибка";
    $fa = "fatal";
}
if(empty($sid)) {
    $error = 6;
    $mess = "Авторизуйтесь";
    $fa = "fatal";
}

 
if($error == 0) {

if($lay == 1){
if($win > $lose){
//Идёт слив
  $rnd = rand(11,20);
}else{
  $rnd = rand(0,20);
}
}
 
if($lay == 2){
if($win > $lose){
//Идёт слив
  $rnd = rand(0,9);
}else{
  $rnd = rand(0,20);
}
}


if($rnd <= 10) {
    $rand = 1;
//Значение для красного 
}
if($rnd > 10 && $rand < 21) {
    $rand = 2;
//Значение для синего
}
if($rnd == 21) {
 $rand = 30;
}


    if($lay == 1) {
        if($rnd <= 10) {
            $fsum = $sum * 2;
            $newcaef = $caef * 1.98;
            $update_sql2 = mysql_query( "UPDATE gamecoin SET caef = $newcaef WHERE id_user = '$user_id'and  off=0");
$lose = "false";
            $mess = "Продолжайте в том же духе";
             $fa = "success";
        }else{
           
            $update_sql2 = mysql_query( "UPDATE gamecoin SET caef = 1.00 WHERE id_user = '$user_id'");
 $update_sql2 = mysql_query( "UPDATE gamecoin SET off = 1 WHERE id_user = '$user_id'");
 $update_sql2 = mysql_query( "UPDATE users SET startcoin = 0 WHERE id = '$user_id'");



					$win_summ = 0;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('COINFLIP', '$user_id', '$login', '', '', '$sum', '', 'lose', '$win_summ');";
mysql_query($insert_sql1);


            $mess = "Вы проиграли";
             $fa = "error";
             $lose = "true";
        }
    }
   // сторона 2
   if($lay == 2) {
        if($rnd > 10 && $rnd < 21) {
            $newcaef = $caef * 1.98;
            $update_sql2 = mysql_query( "UPDATE gamecoin SET caef = $newcaef WHERE id_user = '$user_id'  and  off=0");


  $mess = "Продолжайте в том же духе";
           
            $mess = "Вы выиграли $fsum";
             $fa = "success";
        }else{
           
            $update_sql2 = mysql_query( "UPDATE gamecoin SET caef = 1.00 WHERE id_user = '$user_id'");
 $update_sql2 = mysql_query( "UPDATE gamecoin SET off = 1 WHERE id_user = '$user_id' and off=0");
 $update_sql2 = mysql_query( "UPDATE users SET startcoin = 0 WHERE id= '$user_id'");

$win_summ = 0;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('COINFLIP', '$user_id', '$login', '', '', '$sum', '', 'lose', '$win_summ');";
mysql_query($insert_sql1);
                $mess = "Вы проиграли";
             $fa = "error";
        }
    }
  
   
    }
     $res = array(
'success' => "$fa",
'error' => "$messs",
'flipResult' => "$rand",
'balance' => "$balance",
'new_balance' => "$newbalance",
'message' => "$mess",
'caef1'=> $newcaef,
'nextcaef' =>$newcaef * 1.98,
'lose'=>"$lose",
    );
}
if($type == "checkcoin") {
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $balancewithdraw = $row['balancewithdraw'];
$user_id = $row['id'];
$balance = $row['balance'];
$bonus = $row['bonus'];

    $startcoin = $row['startcoin'];
}
    $sql_select = "SELECT * FROM gamecoin WHERE id_user='$user_id' and off=0";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
	$bet = $row['sum'];
 $caef = $row['caef'];

    }
$nextcaef = $caef * 1.98;


if(   $startcoin == 0) {
    $error = 1;
    $mess = "Игра уже начата";
    $fa = "fatal";
}
if($error == 0) {

    $fa = "success";
      
    }
    $res = array(
'success' => "$fa",
'error' => "$mess",
'caef' => "$caef",
'nextcaef' => "$nextcaef",
'new_balance' => "$newbalance",
'bet' => "$bet"
    );
}
if($type == "finishcoin") {
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $balancewithdraw = $row['balancewithdraw'];
$user_id = $row['id'];
$balance = $row['balance'];
$bonus = $row['bonus'];

    $startcoin = $row['startcoin'];
}
    $sql_select = "SELECT * FROM gamecoin WHERE id_user='$user_id' and  off=0";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $sum = $row['sum'];
 $caef = $row['caef'];

    }


if($startcoin == 0) {
    $error = 1;
    $mess = "Игра уже начата";
    $fa = "fatal";
}
if($error == 0) {

   
        $newbalance = $balance + ($sum * $caef);
        
    $fa = "success";

$win_summ = $sum * $caef;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('COINFLIP', '$user_id', '$login', '', '', '$sum', '', 'win', '$win_summ');";
mysql_query($insert_sql1);

$upd_time = mysql_query( "UPDATE gamecoin SET off =1 WHERE id_user = '$user_id' and off=0");
mysql_query( "UPDATE users SET balance  = $balance + ($sum * $caef) WHERE hash = '$sid' ");
mysql_query( "UPDATE users SET startcoin  = 0 WHERE hash = '$sid'");

    }
    $res = array(
'success' => "$fa",
'error' => "$mess",
'caef' => "$caef",
'nextcaef' => "$nextcaef",
'new_balance' => "$newbalance"
    );
}
if($type == "startcoin") {
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
   // $balancewithdraw = $row['balancewithdraw'];
$id1 = $row['id'];
$balance = $row['balance'];
//$bonus = $row['bonus'];

    $startcoin = $row['startcoin'];
}


    $sum = $_POST['betsize'];

if(   $startcoin == 1) {
    $error = 1;
    $mess = "Игра уже начата";
    $fa = "fatal";
}
if($sum > $balance) {
    $error = 1;
    $mess = "Недостаточно средств";
    $fa = "fatal";
}
if(!is_numeric($sum)) {
    $error = 2;
    $mess = "Введите сумму корректно";
    $fa = "fatal";
}
if($sum < 1) {
    $error = 3;
    $mess = "Минимальная сумма - 1";
    $fa = "fatal";
}

if(empty($sid)) {
    $error = 6;
    $mess = "Авторизуйтесь";
    $fa = "fatal";
}
if($error == 0) {

    $newbalance = $balance - $sum;
       $update_sql2 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql2);      
    $fa = "success";


mysql_query( "Insert into gamecoin ( `id_user`,`caef`, `sum`) 	VALUES ( '{$id1}','1','{$sum}')");


//$upd_time = mysql_query( "UPDATE kot_user SET balancewithdraw  = $balancewithdraw + ($sum / 100 * 7) WHERE hash = '$sid'");

$upd_time = mysql_query( "UPDATE users SET startcoin  = 1 WHERE hash = '$sid'");

       
    }
    $res = array(
'success' => "$fa",
'error' => "$mess",
'num' => "$rand",
'balance' => "$balance",
'new_balance' => "$newbalance"
    );
}


if($type == "cont_BJ") {
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$login = $row['vk_name'];
$user_id = $row['id'];
$startblackjack = $row['startblackjack'];
}


	$sql_select2 = "SELECT * FROM blackjack WHERE user_id='$user_id' and off=1";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$bet = $row['bet'];
$player = $row['player'];
$diller = $row['diller'];
$cards_player = $row['cards_player'];
$cards_diller = $row['cards_diller'];
$can_split = $row['can_split'];
$cards_split_1 = $row['cards_split_1'];
$cards_split_2 = $row['cards_split_2'];
$sum_cards_split_1 = $row['sum_cards_split_1'];
$sum_cards_split_2 = $row['sum_cards_split_2'];
$split = $row['split'];
$diller_suit = $row['diller_suit'];
$player_suit = $row['player_suit'];
$split_suit_1 = $row['split_suit_1'];
$split_suit_2 = $row['split_suit_2'];
}

if($_SESSION['timestamp'] + 2 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
$_SESSION['timestamp'] = time();
}

if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
      
      if($startblackjack != 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Начните игру";
         $fa = "error";
       }
        
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       
	
	
	if ($error == 0){
		if($split == 0){
			$cards_diller = json_decode($cards_diller);
			$cards_diller = json_encode($cards_diller);
			
			$player_suit = json_decode($player_suit);
			$player_suit = json_encode($player_suit);
			
			$diller_suit = json_decode($diller_suit);
			$diller_suit = json_encode($diller_suit);
			
		
		}
		
		if ($split == 1 or $split == 2){
				$split_suit_1 = json_decode($split_suit_1);
			$split_suit_1 = json_encode($split_suit_1);
			
			$split_suit_2 = json_decode($split_suit_2);
			$split_suit_2 = json_encode($split_suit_2);
		}
	
		$fa = "success";
	}
	
	
	$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'cards_player' => "$cards_player",
    'cards_diller' => "$cards_diller",
    'player' => $player,
    'diller' => $diller,
    'cards_split_1' => "$cards_split_1",
    'cards_split_2' => "$cards_split_2",
    'sum_cards_split_1' => "$sum_cards_split_1",
    'sum_cards_split_2' => "$sum_cards_split_2",
    'split' => $split,
    'bet' => $bet,
    'can_split' => $can_split,
    'player_suit' => "$player_suit",
    'diller_suit' => "$diller_suit",
    'split_suit_1' => "$split_suit_1",
    'split_suit_2' => "$split_suit_2"
    );
}

if($type == "split_BJ") {
	
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$login = $row['vk_name'];
$user_id = $row['id'];
$startblackjack = $row['startblackjack'];
}


	$sql_select2 = "SELECT * FROM blackjack WHERE user_id='$user_id' and off=1";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$bet = $row['bet'];
$player = $row['player'];
$diller = $row['diller'];
$cards_player = $row['cards_player'];
$cards_diller = $row['cards_diller'];
$split = $row['split'];
$can_split = $row['can_split'];
$player_suit = $row['player_suit'];
}

if($_SESSION['timestamp'] + 2 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
$_SESSION['timestamp'] = time();
}
if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
    
      if ($can_split != 1){
      	$newbalance = $balance;
         $error = 97;
         $mess = "Ошибка";
         $fa = "error";        
      }
      
      if($startblackjack != 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Начните игру";
         $fa = "error";
       }
         if ($split != 0){
         	
 $newbalance = $balance;
         $error = 97;
         $mess = "Ошибка";
         $fa = "error";        
         }
       
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       
       
       
       $split = 0;
       
	if ($error == 0){
		$cards_player = json_decode($cards_player);
		$cards_diller = json_decode($cards_diller);
		$new_fitst_card = $cards_player[0];
		$split_1 = rand(2, 10);
		$sum_cards_split_1 = $new_fitst_card + $split_1;
		$cards_split_1 = [$new_fitst_card, $split_1];
		$split_2 = rand(2, 10);
		$sum_cards_split_2 = $new_fitst_card + $split_2;
		$cards_split_2 = [$new_fitst_card, $split_2];
		
		$player_suit = json_decode($player_suit);
		$s1 = $player_suit[0];
		$s2 = $player_suit[1];
		
		$s1_1 = rand(0,3);
		$split_suit_1 = [$s1, $s1_1];
		
		$s2_2 = rand(0,3);
		$split_suit_2 = [$s2, $s2_2];
		
		
		$split_suit_1 = array_map('intval', $split_suit_1);
		$split_suit_2 = array_map('intval', $split_suit_2);
		$split_suit_1 = json_encode($split_suit_1);
		$split_suit_2 = json_encode($split_suit_2);
		
		$cards_split_1 = array_map('intval', $cards_split_1);
		$cards_split_2 = array_map('intval', $cards_split_2);
		$cards_split_1 = json_encode($cards_split_1);
		$cards_split_2 = json_encode($cards_split_2);
		$split = 1;
			mysql_query("UPDATE users set balance=$balance - $bet WHERE hash='$sid'");
		$newbalance = $balance - $bet;
		mysql_query("UPDATE blackjack set split_suit_2='$split_suit_2', split_suit_1='$split_suit_1',split=1,cards_split_1='$cards_split_1',cards_split_2='$cards_split_2',sum_cards_split_1='$sum_cards_split_1', sum_cards_split_2='$sum_cards_split_2' WHERE user_id='$user_id' and off=1");
		
	
		 $fa = "success";
	}
	
	
	$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'cards_split_1' => "$cards_split_1",
    'cards_split_2' => "$cards_split_2",
    'sum_cards_split_1' => "$sum_cards_split_1",
    'sum_cards_split_2' => "$sum_cards_split_2",
    'split' => $split,
	'game_off' => "$game_off",
	'split_suit_1' => "$split_suit_1",
	'split_suit_2' => "$split_suit_2",
	
    );
	
}

if($type == "double_BJ") {
	
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$login = $row['vk_name'];
$user_id = $row['id'];
$startblackjack = $row['startblackjack'];
}


	$sql_select2 = "SELECT * FROM blackjack WHERE user_id='$user_id' and off=1";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$bet = $row['bet'];
$player = $row['player'];
$diller = $row['diller'];
$double_card = $row['double_card'];
$cards_player = $row['cards_player'];
$cards_diller = $row['cards_diller'];

}
if($_SESSION['timestamp'] + 2 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
// $_SESSION['timestamp'] = time();
}

if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
  
  if($double_card != 0){
  		$newbalance = $balance;
         $error = 97;
         $mess = "Ошибка";
         $fa = "error";
  }
  if ($balance < $bet){
  	$newbalance = $balance;
         $error = 97;
         $mess = "Недостаточно средств";
         $fa = "error";
  }
    
      if($startblackjack != 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Начните игру";
         $fa = "error";
       }
         
       
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       
       
       
       
       
	if ($error == 0){
		$cards_player = json_decode($cards_player);
		$cards_diller = json_decode($cards_diller);
		$r = rand(2, 10);
		if ($r < 6){
			// $r = rand(8,10);
		}
		$player = $player + $r;
		array_push($cards_player, $r);
		$game_off = 0;
		 
		mysql_query("UPDATE users set balance=$balance - $bet WHERE hash='$sid'");
		$newbalance = $balance - $bet;
		
		$cards_player = array_map('intval', $cards_player);
		$cards_diller = array_map('intval', $cards_diller);
		$cards_player = json_encode($cards_player);
		$cards_diller = json_encode($cards_diller);
		mysql_query("UPDATE blackjack set double_card=2,cards_player='$cards_player', player='$player', bet=$bet * 2 WHERE user_id='$user_id' and off=1");
		if($player > 21){
			$game_off = 1;
			$mess = "Диллер выиграл";
			
			
			$win_summ = 0;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('BLACKJACK', '$user_id', '$login', '', '', '$bet', '', 'lose', '$win_summ');";
mysql_query($insert_sql1);



				mysql_query("UPDATE users set startblackjack=0 WHERE hash='$sid'");
			mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id' and off=1");
	
		}
		
		
		
			if($player == 21){
			$game_off = 2;
			$bet = $bet * 2;
			mysql_query("UPDATE users set balance=$balance + ($bet * 2),  startblackjack=0 WHERE hash='$sid'");
			$newbalance = $balance + ($bet * 2);
			$mess = "Игрок выиграл";
				$newbalance = $balance;
				
					$win_summ = $bet * 2;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('BLACKJACK', '$user_id', '$login', '', '', '$bet', '', 'win', '$win_summ');";
mysql_query($insert_sql1);



			mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id' and off=1");
	
		}
		 $fa = "success";
	}
	
	
	$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'diller' => "$diller",
    'player' => "$player",
    'cards_player' => "$cards_player",
    'cards_diller' => "$cards_diller",
	'game_off' => "$game_off",
	'new_balance' => "$newbalance"
    );
	
}


if($type == "take_BJ") {
	
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$login = $row['vk_name'];
$user_id = $row['id'];
	$startblackjack = $row['startblackjack'];
}


	$sql_select2 = "SELECT * FROM blackjack WHERE user_id='$user_id' and off=1";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$bet = $row['bet'];
$player = $row['player'];
$diller = $row['diller'];
$cards_player = $row['cards_player'];
$cards_diller = $row['cards_diller'];
$split = $row['split'];
$cards_split_1 = $row['cards_split_1'];
$cards_split_2 = $row['cards_split_2'];
$sum_cards_split_1 = $row['sum_cards_split_1'];
$sum_cards_split_2 = $row['sum_cards_split_2'];
$diller_suit = $row['diller_suit'];
$player_suit = $row['player_suit'];

$split_suit_1 = $row['split_suit_1'];
$split_suit_2 = $row['split_suit_2'];
}

if($_SESSION['timestamp'] + 2 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
$_SESSION['timestamp'] = time();
}

if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
    
      
           if($startblackjack != 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Начните игру";
         $fa = "error";
       }
      
       
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       
       
       
       
       if($error != 0){
       		$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    );
       }
	if ($error == 0){
		
		if($split == 0){
		$cards_player = json_decode($cards_player);
		$cards_diller = json_decode($cards_diller);
		$r = rand(2, 10);
		if ($player + $r > 17){
			// $r = rand($r, 10);
		}
		if ($player + $r == 21){
			// $r = rand(2, 5);
		}
		$player = $player + $r;
		array_push($cards_player, $r);
		$game_off = 0;
		 
				
		
		$cards_player = array_map('intval', $cards_player);
		$cards_diller = array_map('intval', $cards_diller);
		$cards_player = json_encode($cards_player);
		$cards_diller = json_encode($cards_diller);
		
		
		$player_suit_1 = rand(0,3);
			$player_suit = json_decode($player_suit);
    	array_push($player_suit, $player_suit_1);
       	$player_suit = array_map('intval', $player_suit);
       $player_suit = json_encode($player_suit);
       
       
       
       
       
		mysql_query("UPDATE blackjack set player_suit='$player_suit', cards_player='$cards_player', double_card=1,can_split=0, player='$player' WHERE user_id='$user_id' and off=1");
		if($player > 21){
			$game_off = 1;
			$mess = "Диллер выиграл";
				$newbalance = $balance;
					mysql_query("UPDATE users set startblackjack=0 WHERE hash='$sid'");
			mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id' and off=1");
	
		}
		
		if($player == 21){
			$game_off = 2;
			$mess = "Игрок выиграл";
				$newbalance = $balance + ($bet * 2);
				
					mysql_query("UPDATE users set balance=$newbalance, startblackjack=0 WHERE hash='$sid'");
			mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id' and off=1");
	
		}
		
		 $fa = "success";
		$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'diller' => "$diller",
    'player' => "$player",
    'cards_player' => "$cards_player",
    'cards_diller' => "$cards_diller",
	'game_off' => "$game_off",
	'split' => 0,
	'player_suit' => "$player_suit"
    );
		}
		
		
		
		
		
		
		///////////////////////////////////
		
		if ($split == 1){
			
		$cards_split_1 = json_decode($cards_split_1);
		$r = rand(2, 10);
		$sum_cards_split_1 = $sum_cards_split_1 + $r;
		array_push($cards_split_1, $r);
		$game_off = 0;
		 
				
		
		$cards_split_1 = array_map('intval', $cards_split_1);
		$cards_split_1 = json_encode($cards_split_1);
		
		
		$split_suit_1 = json_decode($split_suit_1);
		$s = rand(0,3);
		array_push($split_suit_1, $s);
		$split_suit_1 = array_map('intval', $split_suit_1);
		$split_suit_1 = json_encode($split_suit_1);
		
		$spliting = 1;
		if($sum_cards_split_1 > 21){
			$spliting = 2;
			
		}
		
		if($sum_cards_split_1 == 21){
			$spliting = 2;
			
		}
			mysql_query("UPDATE blackjack set split_suit_1='$split_suit_1',split='$spliting', cards_split_1='$cards_split_1', sum_cards_split_1='$sum_cards_split_1' WHERE user_id='$user_id' and off=1");
	
			
			
			
				 $fa = "success";
		$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'cards_split_1' => "$cards_split_1",
    'cards_split_2' => "$cards_split_2",
    'sum_cards_split_1' => "$sum_cards_split_1",
    'sum_cards_split_2' => "$sum_cards_split_2",
    'split' => $spliting,
	'game_off' => "$game_off",
	'split_suit_1' =>"$split_suit_1"
    );
		}
		
		///////////////////////////////////
		
		if ($split == 2){
			
		$cards_split_2 = json_decode($cards_split_2);
		$r = rand(2, 10);
		$sum_cards_split_2 = $sum_cards_split_2 + $r;
		array_push($cards_split_2, $r);
		$game_off = 0;
		 
				
		
		$cards_split_2 = array_map('intval', $cards_split_2);
		$cards_split_2 = json_encode($cards_split_2);
		
		$spliting = 2;
		if($sum_cards_split_2 > 21){
			$spliting = 2;
			$game_off = 1;
		}
		
		if($sum_cards_split_2 == 21){
			$spliting = 2;
			$game_off = 1;
			
		}
			mysql_query("UPDATE blackjack set split='$spliting', cards_split_2='$cards_split_2', sum_cards_split_2='$sum_cards_split_2' WHERE user_id='$user_id' and off=1");
	
			
	$fa = "success";
		$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'cards_split_1' => "$cards_split_1",
    'cards_split_2' => "$cards_split_2",
    'sum_cards_split_1' => "$sum_cards_split_1",
    'sum_cards_split_2' => "$sum_cards_split_2",
    'split' => $spliting,
	'game_off' => "$game_off"
    );
		}
		
	}
	
}

if($type == "stop_BJ") {
	
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
		$startblackjack = $row['startblackjack'];
$balance = $row['balance'];
$login = $row['vk_name'];
$user_id = $row['id'];
}


	$sql_select2 = "SELECT * FROM blackjack WHERE user_id='$user_id' and off=1";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$bet = $row['bet'];
$player = $row['player'];
$diller = $row['diller'];
$cards_player = $row['cards_player'];
$cards_diller = $row['cards_diller'];
$diller_card_hidden = $row['diller_card_hidden'];

$split = $row['split'];
$cards_split_1 = $row['cards_split_1'];
$cards_split_2 = $row['cards_split_2'];
$sum_cards_split_1 = $row['sum_cards_split_1'];
$sum_cards_split_2 = $row['sum_cards_split_2'];
$diller_suit = $row['diller_suit'];
$diller_suit_hidden = $row['diller_suit_hidden'];
}

if($_SESSION['timestamp'] + 1 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
$_SESSION['timestamp'] = time();
}

if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
  
  
      if($startblackjack != 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Начните игру";
         $fa = "error";
       }
      
         
       
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       
       
        if($error != 0){
       		$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    );
       }
	
       
       
	if ($error == 0){
		
		
		if($split == 0){
		$cards_player = json_decode($cards_player);
		$diller_suit = json_decode($diller_suit);
		
		array_push($diller_suit, $diller_suit_hidden);
		
		
		$diller = $diller + $diller_card_hidden;
		$cards_diller = json_decode($cards_diller);
		array_push($cards_diller, $diller_card_hidden);
	
		while ($diller < 16){
       	$card_d = rand(1, 10);
       	if ($diller + $card_d > 21){
       		// $card_d = rand(1, 4);
       	}
       	$diller += $card_d;
       	array_push($cards_diller, $card_d);
       	
       	
       	$diller_suit_1 = rand(0,3);
    	array_push($diller_suit, $diller_suit_1);
       
       }
       
       
       	$diller_suit = array_map('intval', $diller_suit);
       $diller_suit = json_encode($diller_suit);
       
       
     if ($diller > $player and $diller <= 21){
     	$newbalance = $balance;
     	$mess = 'Диллер выиграл';
     		$game_off = 1;
     		
					$win_summ = 0;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('BLACKJACK', '$user_id', '$login', '', '', '$bet', '', 'lose', '$win_summ');";
mysql_query($insert_sql1);


     }else if($diller == $player){
     		$newbalance = $balance + $bet;
     			$mess = 'Ничья';
     				$game_off = 3;
     }else{
     	$newbalance = $balance + ($bet * 2);
     	$mess = 'Игрок выиграл';
     	
					$win_summ = $bet * 2;
			$insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('BLACKJACK', '$user_id', '$login', '', '', '$bet', '', 'win', '$win_summ');";
mysql_query($insert_sql1);

     		$game_off = 2;
     }
     
    		mysql_query("UPDATE users set balance=$newbalance, startblackjack=0 WHERE id='$user_id'");
		mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id'");
		 $fa = "success";
	
	
	$cards_diller = array_map('intval', $cards_diller);
	$cards_player = json_encode($cards_player);
	$cards_diller = json_encode($cards_diller);
	$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'diller' => "$diller",
    'player' => "$player",
    'cards_player' => "$cards_player",
    'cards_diller' => "$cards_diller",
    'game_off'=>"$game_off",
    'split' => 0,
'diller_suit' => $diller_suit,
    );
	}
	
	if ($split == 1){
		$splitting = 2;
		 $fa = "success";
		 	mysql_query("UPDATE blackjack set split=2 WHERE user_id='$user_id' and off=1");
	
		 
			$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$newbalance",
    'diller' => "$diller",
    'player' => "$player",
    'cards_player' => "$cards_player",
    'cards_diller' => "$cards_diller",
    'game_off'=>"$game_off",
    'split' => $splitting,
		);
		
	}
	
	if($split == 2){
		$splitting = 0;
		 $fa = "success";
		mysql_query("UPDATE blackjack set split='$spliting' WHERE user_id='$user_id' and off=1");
	
	
		
		$no_cards_diller = 0;
		
		$diller = $diller + $diller_card_hidden;
		$cards_diller = json_decode($cards_diller);
		array_push($cards_diller, $diller_card_hidden);
		
		while ($diller < 16){
       	$card_d = rand(1, 10);
       	$diller += $card_d;
       	array_push($cards_diller, $card_d);
       }
       
       
     if ($sum_cards_split_1 <= 21){
     if ($diller > $sum_cards_split_1 and $diller <= 21){
     	$newbalance1 = $balance;
     	$mess = 'Диллер выиграл';
     		$game_off_split_1 = 1;
     }else if($diller == $sum_cards_split_1){
     		$newbalance1 = $balance + $bet;
     			$mess = 'Ничья';
     				$game_off_split_1 = 3;
     }else {
     	if ($sum_cards_split_1 <= 21){
     	$newbalance1 = $balance + ($bet * 2);
     	$mess = 'Игрок выиграл';
     		$game_off_split_1 = 2;
     	}else{
     			$newbalance1 = $balance;
     	}
     }
     }else{
     		$newbalance1 = $balance;
     		$no_cards_diller += 1;
     		$game_off_split_1 = 1;
     } 
     
     mysql_query("UPDATE users set balance=$newbalance1, startblackjack=0 WHERE id='$user_id'");
     
     
     $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];

}
   
     if ($sum_cards_split_2 <= 21){
     if ($diller > $sum_cards_split_2 and $diller <= 21){
     	$newbalance = $balance;
     	$mess = 'Диллер выиграл';
     		$game_off_split_2 = 1;
     }else if($diller == $sum_cards_split_2){
     		$newbalance = $balance + $bet;
     			$mess = 'Ничья';
     				$game_off_split_2 = 3;
     }else{
     	if ($sum_cards_split_2 <= 21){
     	$newbalance1 = $balance + ($bet * 2);
     	$mess = 'Игрок выиграл';
     		$game_off_split_2 = 2;
     	}
     }
     }else{
     		$newbalance = $balance;
     		$no_cards_diller += 1;
     		$game_off_split_2 = 1;
     } 
     mysql_query("UPDATE users set balance=$newbalance, startblackjack=0 WHERE id='$user_id'");
     
     
      $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];

}
		mysql_query("UPDATE blackjack set off=2 WHERE user_id='$user_id'");
		 $fa = "success";
		 $cards_diller = json_encode($cards_diller);
		 
		 if ($no_cards_diller == 2){
		 	$no_diller = 1;
		 	$game_off_split_1 = 1;
		 	$game_off_split_2 = 1;
		 }else{
		 	$no_diller = 0;
		 }
			$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' => "$balance",
    'diller' => "$diller",
    'sum_cards_split_1' => "$sum_cards_split_1",
    'sum_cards_split_2' => "$sum_cards_split_2",
    'cards_diller' => "$cards_diller",
    'game_off_split_1'=>"$game_off_split_1",
    'game_off_split_2'=>"$game_off_split_2",
    'split' => $splitting,
    'no_diller' => $no_diller
		);
	}
	}
}

if($type == "start_BJ") {
	$bet = $_POST['bet'];
	$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$startblackjack = $row['startblackjack'];
$balance = $row['balance'];
$login = $row['login'];
$user_id = $row['id'];
$wager = $row['wager'];
$admin = $row['admin']; 
}


if($_SESSION['timestamp'] + 2 > time()){ 
$error = 3;
$fa = "error";
$mess = "Не нужно нажимать так быстро!";
} 
else{
$_SESSION['timestamp'] = time();
}


if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
  
  if ($startblackjack != 0){
  	$newbalance = $balance;
  	$error = 4;
  	$mess = "У вас уже есть активная игра";
  	$fa = "error";
  }
    
       if($bet > $balance) {
         $newbalance = $balance;
         $error = 4;
         $mess = "Недостаточно средств";
         $fa = "error";
       }
         
       
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       if($bet < 1) {
         $newbalance = $balance;
         $error = 64;
         $mess = "Ставки от 1";
         $fa = "error";
       }
       
       if(!is_numeric($bet)) {
           $newbalance = $balance;
         $error = 77;
         $mess = "Введите сумму корректно";
         $fa = "error";
          
       }
      
     
       
      
       
       
	if ($error == 0){
		 $diller_1 = rand(2, 10);
       $diller_2 = rand(2, 10);
       $diller_m = json_encode([$diller_1]);
       $player_1 = rand(2, 10);
       $player_2 = rand(2, 10);
       
       //$player_2 = $player_1;
       
       $player_1_2 = $player_1 + $player_2;
       $player_m = json_encode([$player_1, $player_2]);
       $can_split = 0;
       if ($player_1 == $player_2){
       	$can_split = 1;
       }
       
       $player_suit_1 = rand(0,3);
       $player_suit_2 = rand(0,3);
       $player_suit = [$player_suit_1,  $player_suit_2];
       	$player_suit = array_map('intval', $player_suit);
       $player_suit = json_encode($player_suit);
       
       
        $diller_suit_1 = rand(0,3);
        $diller_suit_hidden = rand(0,3);
        $diller_suit = [$diller_suit_1];
         	$diller_suit = array_map('intval', $diller_suit);
       $diller_suit = json_encode($diller_suit);
		$newbalance = $balance - $bet;
		mysql_query("UPDATE users set wager=$wager - $bet,balance=$balance - $bet, startblackjack=1 WHERE hash='$sid'");
		mysql_query("INSERT INTO blackjack set diller_suit_hidden=$diller_suit_hidden,diller_suit='$diller_suit',player_suit='$player_suit',off='1',can_split=$can_split, user_id='$user_id', bet='$bet', diller_card_hidden='$diller_2', player='$player_1_2', diller='$diller_1', cards_player='$player_m', cards_diller='$diller_m'");
		
		
		 $fa = "success";
	}
	
	$res = array(
	'success' => "$fa",
	'error' => "$mess",
    'new_balance' =>  $newbalance,
    'diller' => "$diller_1",
    'player' => "$player_1_2",
    'cards_player' => $player_m,
    'cards_diller' => "$diller_m",
    'can_split' => "$can_split",
    'diller_suit' => "$diller_suit",
    'player_suit' => "$player_suit"

    );
	
}
if($type == "minbet") {
 // $winsum = $_POST['win'];
  
  $sum = $_POST['sum'];
  $per = $_POST['per'];
  $nwin = ($per * 10000) - 1;
  $winsum = round(((100 / $per * $sum) - $sum), 2);
  //$nwin = $_POST['nwin'];
  $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$balance = $row['balance'];
$ban = $row['ban'];
$sliv = $row['sliv'];
$fart = $row['win'];
$login = $row['vk_name'];
$user_id = $row['id'];
}
 
  
 
 
  if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
     if($_SESSION['hash'] != '') {
       if($sum > $balance) {
         $newbalance = $balance;
         $error = 4;
         $mess = "Недостаточно средств";
         $fa = "error";
       }
         if (round($winsum, 2) + $sum == round($sum, 2)){
       	$newbalance = $balance;
         $error = 77;
         $mess = "Выигрыш равняется сумме ставки";
         $fa = "error";
       	
       }
       if($per > 90 || $per < 1) {
         $newbalance = $balance;
         $error = 98;
         $mess = "% Шанс от 1 до 90";
         $fa = "error";
       }
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       if($sum < 0.01) {
         $newbalance = $balance;
         $error = 64;
         $mess = "Ставки от 0.01";
         $fa = "error";
       }
       if($sum > $max_bet) {
         $newbalance = $balance;
         $error = 69;
         $mess = "Макс. ставка $max_bet";
         $fa = "error";
       }
       if(!is_numeric($sum)) {
           $newbalance = $balance;
         $error = 77;
         $mess = "Введите сумму корректно";
         $fa = "error";
          
       }
       
     
       
       if($error == 0) {
       	

    $rand = rand(0, 999999);  
     $hash = hash('sha512', $rand);	
  if($rand <= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('DICE', '$user_id', '$login', '$rand', '0 - $nwin', '$summ', '$per', 'win', '$winsumm');";
mysql_query($insert_sql1);
  $newbalance = $balance + $winsum;
   $mess = "Выпало <b>$rand</b>";
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $fa = "success";
  }
       }
       
       if($error == 0) {
  if($rand > $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('DICE', '$user_id', '$login', '$rand', '0 - $nwin', '$summ', '$per', 'lose', '0');";
mysql_query($insert_sql1);
  $newbalance = $balance - $sum;
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $error = 1;
  $mess = "Выпало <b>$rand</b>";
  $fa = "error";
  }
   }  
     }
     
  $winning = $winsum + $sum;
  $res = array(
	'success' => "$fa",
	'error' => "$mess",
	'number' => "$rand",
    'hash' => "$hash",
    'random' => "$random",
    'sign' => "$signature",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance"

    );
}


if($type == "maxbet") {
  // $winsum = $_POST['win'];
  $per = $_POST['per'];
  $nwin = 1000000 - ($per * 10000);
  //$nwin = $_POST['nwin'];
  $sum = $_POST['sum'];
  $winsum = round(((100 / $per * $sum) - $sum), 2);
  $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$balance = $row['balance'];
$ban = $row['ban'];
$sliv = $row['sliv'];
$fart = $row['win'];
$login = $row['vk_name'];
$user_id = $row['id'];
}
 $sql_select27 = "SELECT COUNT(*) FROM kot_chance WHERE per='$per'";
$result27 = mysql_query($sql_select27);
$row = mysql_fetch_array($result27);
if($row)
{	
$get_per = $row['COUNT(*)'];
}
if($get_per != 0) {
  $sql_select0 = "SELECT * FROM kot_chance WHERE per='$per'";
$result0 = mysql_query($sql_select0);
$row = mysql_fetch_array($result0);
if($row)
{	
$active_chance = $row['active'];
$chance = $row['chance'];
$is_drop = $row['is_drop'];
}
}
 
 
 
  $hash = hash('sha512', $rand);
  if((empty($_SESSION['hash'])) || $_SESSION['login'] != 1){
    $error = 2;
    $mess = "Авторизуйтесь";
    $fa = "error";
  }
  
     if($_SESSION['hash'] != '') {
       if($sum > $balance) {
         $newbalance = $balance;
         $error = 4;
         $mess = "Недостаточно средств";
         $fa = "error";
       }
       
        if (round($winsum, 2) + $sum == round($sum, 2)){
       	$newbalance = $balance;
         $error = 77;
         $mess = "Выигрыш равняется сумме ставки";
         $fa = "error";
       	
       }
       if($per > 90 || $per < 1) {
         $newbalance = $balance;
         $error = 98;
         $mess = "% Шанс от 1 до 90";
         $fa = "error";
       }
       if($ban == 1) {
         $newbalance = $balance;
         $error = 97;
         $mess = "Ваш аккаунт заблокирован";
         $fa = "error";
       }
       if($sum < 0.01) {
         $newbalance = $balance;
         $error = 64;
         $mess = "Ставки от 0.01";
         $fa = "error";
       }
       if($sum > $max_bet) {
         $newbalance = $balance;
         $error = 69;
         $mess = "Макс. ставка $max_bet";
         $fa = "error";
       }
       if(!is_numeric($sum)) {
           $newbalance = $balance;
         $error = 77;
         $mess = "Введите сумму корректно";
         $fa = "error";
          
       }
       
      
      
       
       
       if($error == 0) {
       	
     $rand = rand(0, 999999);
      $hash = hash('sha512', $rand);  
  if($rand >= $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('DICE', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$per', 'win', '$winsumm');";
mysql_query($insert_sql1);
 $mess = "Выпало <b>$rand</b>";
  $newbalance = $balance + $winsum;
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $fa = "success";
  }
       } 
     }
    
       
       if($error == 0) {
  if($rand < $nwin)
  {
    $summ = round($sum, 2);
    $winsumm = round($winsum, 2) + $sum;
  $insert_sql1 = "INSERT INTO `kot_games` (`game`,`user_id`, `login`, `number`, `cel`, `sum`, `chance`, `type`, `win_summa`) 
	VALUES ('DICE', '$user_id', '$login', '$rand', '$nwin - 999999', '$summ', '$per', 'lose', '0');";
mysql_query($insert_sql1);
  $newbalance = $balance - $sum;
    $update_sql4 = "Update users set balance='$newbalance' WHERE hash='$sid'";
      mysql_query($update_sql4);
  $error = 1;
  $mess = "Выпало <b>$rand</b>";
  $fa = "error";
  }
       }
     
     
  $winning = $winsum + $sum;
  $res = array(
	'success' => "$fa",
	'error' => "$mess",
	'number' => "$rand",
    'hash' => "$hash",
     'random' => "$random",
    'sign' => "$signature",
    'fullwin' => "$winning",
    'balance' => "$balance",
    'new_balance' => "$newbalance"

    );
}

if($type == "bonusQiwi") {
	
	 $error = 2;
    $status = "error";
    $mess = "Временно недоступно";
    
    
	$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{   
$bdate = $row['timeqiwi'];
$balance = $row['balance'];
$user_id = $row['id'];
}
$time = time();
$rnd = rand(100, 300) / 100;
$f_time = $time - $bdate;
$w_time = 86400 - $f_time;
$newbalance = $balance + $rnd;
if(empty($sid)) {
    $error = 2;
    $status = "error";
    $mess = "Необходимо авторизоваться";
}
if($f_time < 86400) {
    $error = 1;
    $status = "error";
    $mess = "Ожидайте еще $w_time сек";
} 


$sql_select23 = "SELECT SUM(suma) FROM payments WHERE user_id='$user_id' and status=2";
$result23 = mysql_query($sql_select23);
$row = mysql_fetch_array($result23);
if($row)
{
$sumdep = $row['SUM(suma)'];
}

if($sumdep == '') {
 $sumdep = 0; 
}
/*
if($sumdep < 100) {
    $error = 1;
    $status = "error";
    $mess = "Пополните баланс на 100 руб.";
} 
*/





if($error == 0) {
	$amount = rand(100, 200) / 100;
	$tel = $_POST['qiwi_wallet'];
	$findme = '+';
	$pos = strpos($tel, $findme);
	if ($pos  !== false){
	$tel = explode("+", $tel)[1];
	}
	$comment = 'GameWin';
	$qiwi = new Qiwi($phone, $token);
	  $sendMoney = $qiwi->sendMoneyToQiwi([
	      'id' => time() . '000',
	      'sum' => [
	          'amount'   => $amount,
	          'currency' => '643'
	      ],
	      'paymentMethod' => [
	          'type' => 'Account',
	          'accountId' => '643'
	      ],
	      'comment' => $comment,
	      'fields' => [
	          'account' => '+'.$tel
	      ]
	  ]);
	  
$update_sql1 = "UPDATE users SET wager = $wager + $rnd WHERE hash = '$sid' ";
    mysql_query($update_sql1);
    
    $upd_time = mysql_query( "UPDATE users SET timeqiwi = '$time' WHERE hash = '$sid'");
    $gift_mess = "Получено <b>$amount р</b>";
    $status = "success";
}
$res = array('fa' => "$status", 'error' => "$mess", 'newbalance' => "$balance", 'gift' => "$gift_mess");
}

if($type == "mess") {
    $message = $_POST['message'];
     $sql_select = "SELECT *  FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{   
$login = $row['vk_name'];
$img = $row['img'];
$ban = $row['chat_ban'];
$admin = $row['admin'];
$balance = $row['balance'];
}
if($ban == '1'){
  $error = 2;
  $fa = "error";
  $mess = "Вы забанены";
}
if(trim($message) == ''){
  $error = 2;
  $fa = "error";
  $mess = "Введите сообщение";
}


if($error == 0)
{ 
    $message = htmlspecialchars($message);

$sql1 = "SELECT * FROM chat_config "; //выборка всего
        $result1 = mysql_query($sql1) or die(mysql_error());
$rows1 = mysql_fetch_array($result1);
$chat_quiz = $rows1['quiz'];
$answer = htmlspecialchars($rows1['answer']);
$priz = $rows1['priz'];
    
    if ($admin > 0){
    $image = explode( '/simg', $message )[1];
  $unid = explode( '/unban', $message )[1];
  $banid = explode( '/ban', $message)[1];
  $sys = explode( '/sys', $message)[1];
$quiz = explode( ' ', $message)[0];
  $promo = explode( '/promo ', $message)[1];
    
if($promo){
    $datas = date("d.m.Y");
    $datass = date("H:i:s");
    $data = "$datas $datass";
  $activations = rand(10, 20);
  $promosum = rand(1, 3);
     $quer = mysql_query("INSERT INTO `promo` (`id`, `date`, `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$data', '$promo', '$promosum', '$activations', '0', '');");
     
    
$query1 = mysql_query("INSERT INTO `messages` (`text_promo`,`sum_promo`,`promo`, `active_promo`) VALUES ('$promo', '$promosum', 1, '$activations')");

    
}else if($sys){
    $login = 'System';
$img = "https://sun9-57.userapi.com/c205820/v205820318/6f527/YF1QSArbx2Q.jpg";
  $update_sql2 = "insert into messages  (name, img, text, admin_mess) values ('$login', '$img', '$sys', 1)";
      
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());
}

else if($quiz == "/quiz"){
$question = explode( " , ",$message)[1];
$answer = explode( " , ", $message)[2];
$priz = explode(" , ", $message)[3];
$update_sql2 = "insert into messages  (question, answer, priz, quiz) values ('$question', '$answer','$priz', 1)";
      
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());

  mysql_query( "update chat_config  set answer='$answer'");
      mysql_query( "update chat_config  set quiz='1'");
    mysql_query( "update chat_config  set priz='$priz'");
}
else if($message == "/clear"){
$login = 'System';
$img = "https://sun9-57.userapi.com/c205820/v205820318/6f527/YF1QSArbx2Q.jpg";
$message = "Была произведена очистка чата";
 $update_sql2 = "TRUNCATE messages";
      $admin_mess = 1;
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());

     $update_sql2 = "insert into messages  (name, img, text, admin_mess) values ('$login', '$img', '$message', '$admin_mess')";
      
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());
      
}else{
        $update_sql2 = "insert into messages  (name, img, text, admin_mess) values ('$login', '$img', '$message', '$admin')";
      
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());
    }
}else{
    
    $update_sql2 = "insert into messages  (name, img, text , admin_mess) values ('$login', '$img', '$message' , '$admin')";
      
      mysql_query($update_sql2) or die("Ошибка вставки" . mysql_error());
}
      
     


 $fa = "success";
      
}
// массив для ответа
$res = array(
    'success' => "$fa",
    'error' => "$mess",

    );
}



if($type=="rotate_b"){

$s = mysql_fetch_array(mysql_query("SELECT * FROM team_config  "));
$rotate = $s['rotate'];

$s = mysql_fetch_array(mysql_query("SELECT * FROM `battle_winners` ORDER BY `id` DESC"));
$t = $s['tickets_black'];

if($rotate < $t){
$color = 1;
}else{
    $color = 2;
}
$fa = "success";
$res = array(
    'color' => "$color",
	'success' => "$fa",
	'error' => "$mess",
	'rotate' => "$rotate",
	
    );
}


if($type=="rotate_j"){

   $r = mysql_fetch_array(mysql_query("SELECT * FROM `room_winners` ORDER BY `id` DESC LIMIT 1"));
$rand = $r['result'];
$random = $r['random'];
$signature = $r['signature'];

$fa = "success";
$res = array(
    'signature' => "$signature",
	'success' => "$fa",
	'error' => "$mess",
	'random' => "$random",
	
	
    );
}


if($type=="rotate_w"){

$s = mysql_fetch_array(mysql_query("SELECT * FROM wheel_config  "));
$rotate = $s['rotate'];
$s = mysql_fetch_array(mysql_query("SELECT * FROM `wheel_winners` ORDER BY `id` DESC"));
$t = $s['login'];
$wheel_id = $s['id'];
$rotate = $s['result'];
if($t == "X2"){
$color = 2;
} 
else if($t == "X3"){
$color = 3;
}
else if($t == "X5"){
$color = 5;
}
else if($t == "X50"){
$color = 50;
}


if ($wheel_id % 2 == 0){
	$x = 5;
}else{
$x = 1;	
}
$fa = "success";
$res = array(
    'color' => "$color",
	'success' => "$fa",
	'error' => "$mess",
	'rotate' => "$rotate",
	'x1' => "$x"
    );
}
if($type=="checkgame"){
$id_game = $_POST['id_game'];
$s = mysql_fetch_array(mysql_query("SELECT * FROM battle_winners WHERE id='$id_game'"));
$result = $s['result'];
$tred = $s['tickets_red'];
$tblack = $s['tickets_black'];
$sign = $s['signature'];
$random = $s['random'];
$fa = "success";
$res = array(
	'success' => "$fa",
	'error' => "$mess",
	'result' => "$result",
	'tred' => "$tred",
'tblack' => "$tblack",
'random' =>"$random",
'sign' => "$sign",
    );
}
if($type=="battletimer"){
    
$s = mysql_fetch_array(mysql_query("SELECT * FROM team_config "));
$stop = $s['stop'];

$fa = "success";
$res = array(
	'success' => "$fa",
	'error' => "$mess",
	'stop' => "$stop",
	
    );
}
if($type == "kenogamecheck")
{
    $id = $_POST['id'];
    
 //   $id = 10;
    
    
 $arr = [];
$sql_select = "SELECT * FROM `keno-game` WHERE id=$id";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
	
$caef = $row['caef'];
$bet = $row['bet'];


$win = $caef * $bet;
  
$random = $row['random'];

$signature = $row['signature'];
$signature = str_replace('"', '', $signature);

$gems = $row['gems'];
$gems = json_encode($gems);
$gems = str_replace('"', '', $gems);
$gems = str_replace('[', '', $gems);
$gems = str_replace(']', '', $gems);
$gems = explode(',', $gems);
$gems = array_map('intval', $gems);

$click = $row['selectgem'];
$click = json_encode($click);
$click = str_replace('"', '', $click);
$click = str_replace('[', '', $click);
$click = str_replace(']', '', $click);
$click = explode(',', $click);
$click = array_map('intval', $click);


$click1 = $row['selectgem'];
$click1 = json_encode($click1);
$click1 = str_replace('"', '', $click1);



$count = 0;
for ($i = 0; TRUE; $i++) {
if(isset($click[$i]))
$count++;
else
break;
}
$count_click = $count;



$win_active = [];
$lose_active =  [];
        
        
 for($i=0;$i<$count;$i++){
     
     if(in_array($gems[$i], $click)){
         
        
         array_push($win_active, $gems[$i]);
     }else{
         
          array_push($lose_active, $gems[$i]);
     }
}
$caef = $win / $bet;
$len = 0;
for ($i = 0; TRUE; $i++) {
if(isset($lose_active[$i]))
$len++;
else
break;
}
if($len == 0){
$win = 0;
}
        
        
        $gems = json_encode($gems);
  $click = json_encode($click);              
$win_active = array_map('intval', $win_active);
$lose_active = array_map('intval', $lose_active);

$win_active = json_encode($win_active);
$lose_active = json_encode($lose_active);
    $res = array(
	'success' => "success",
		'mines_id' => "$id",
'bet' => "$bet",
'win' => "$win",
'caef'=>"$caef",
'mines'=>$gems,
'click'=>$click,
'count'=>$count_click,
'win_active'=>$win_active,
'lose_active'=>$lose_active,
'random'=>$random,
'signature'=>$signature
    );

}


if($type == "minesgamecheck")
{
    $id = $_POST['id'];
 $arr = [];
$sql_select = "SELECT * FROM `mines-game` WHERE id=$id and onOff = 2";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
	
$onOff = $row['onOff'];
if($onOff == 2){
    $bet = $row['bet'];
    $win = $row['win'];
  
$random = $row['random'];
$signature = $row['signature'];
$signature = str_replace('"', '', $signature);
$mines = $row['mines'];
$mines = unserialize($mines);
$click = $row['click'];
$click = unserialize($click);
$click = array_map('intval', $click);

$count = 0;
for ($i = 0; TRUE; $i++) {
if(isset($click[$i]))
$count++;
else
break;
}
$count_click = $count;



$win_active = [];
$lose_active =  [];
        
        
 for($i=0;$i<$count;$i++){
     
     if(in_array($click[$i], $mines)){
         
        
         array_push($lose_active, $click[$i]);
     }else{
         
          array_push($win_active, $click[$i]);
     }
}
$caef = $win / $bet;
$len = 0;
for ($i = 0; TRUE; $i++) {
if(isset($lose_active[$i]))
$len++;
else
break;
}
if($len != 0){
$win = 0;
}
        $mines = json_encode($mines);
  $click = json_encode($click);              

$win_active = json_encode($win_active);
$lose_active = json_encode($lose_active);

}
    $res = array(
	'success' => "success",
		'mines_id' => "$id",
'bet' => "$bet",
'win' => "$win",
'caef'=>"$caef",
'mines'=>$mines,
'click'=>$click,
'count'=>$count_click,
'win_active'=>$win_active,
'lose_active'=>$lose_active,
'random'=>$random,
'signature'=>$signature
    );

}

if($type == 'autoselect_mines'){
	$sql_select = "SELECT * FROM `users` WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
$id = $row['id'];
    $query = ("SELECT * FROM `mines-game` WHERE id_users = '$id' AND onOff = '1'");
    $result = mysql_query($query);
    $games = mysql_fetch_array($result);

    if($games){
        $click = $games['click'];
        $click = unserialize($click);

        $select = mt_rand(1,25);

        if(in_array($select,$click)){
            while(in_array($select,$click)){
            $select = mt_rand(1,25);
            }
        }

        $res = array('success'=>'true','select'=>"$select");
    }
}
if($type == "minesnew")
{
  //  $id = $_POST['id'];
 $arr = [];
$sql_select = "SELECT * FROM `users` WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
$id = $row['id'];


$sql_select = "SELECT * FROM `mines-game` WHERE id_users='$id' and onOff = '1'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
	
    $bet = $row['bet'];
    $win = $row['win'];
  
$mines = unserialize($mines);
$click = $row['click'];
$click = unserialize($click);
$click = array_map('intval', $click);


        
$caef = $win / $bet;

        $mines = json_encode($mines);
  $click = json_encode($click);              

    $res = array(
	'success' => "success",
		'mines_id' => "$id",
'bet' => "$bet",
'win' => "$win",
'click'=>$click,
    );

}

if($type == "save_settings")
{
    $qiwi = $_POST['qiwi'];
    $vk_page = htmlspecialchars($_POST['vk_page']);
    $vk_page = str_replace("https", "http", $vk_page);
    $vk_page = htmlspecialchars($vk_page);
    $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query( $sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $sid = $row['hash'];
    $guess = $row['guess'];
    $settings = $row['settings'];
    
}

$sql_select2 = "SELECT COUNT(*) FROM users WHERE qiwi='$qiwi' and ban=0";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{	
$c = $row['COUNT(*)'];
}
if($c > 1){
  $error = 1;
	$mess = "Мультаккаунты запрещены";
	$fa = "error";	
}



$guess1 = 3 - $guess - 1;

if ($qiwi == '') {
    $error = 1;
	$mess = "Введите свой кошелек для выводов";
	$fa = "error";	
  }

  

  if ($settings == 1) {
    $error = 1;
	$mess = "Ошибка";
	$fa = "error";	
  }

  
  if($error == 0) {
    mysql_query("UPDATE users set qiwi='$qiwi', settings=1 WHERE hash='$sid'");
    
  $fa = "success";
  
 
  
}

    $res = array(
	'success' => "$fa",
	'error'=>"$mess",
		'summa' => "$s",
'orderid' => "$vk_page",
'link' => "$sid",
    );

}

if($type == "activePromo") {
  $sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$tp = $row['time_promo'];
$wager = $row['wager'];
$user_id = $row['id'];
$ban = $row['ban'];
$balance = $row['balance'];
}
// инфу о пользователе мы получили, получаем промо
$promo = $_POST['promoactive']; // получаем введенное промо
$sql_select = sprintf("SELECT COUNT(*) FROM promo WHERE name='%s'", mysql_real_escape_string($promo));
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
$count = $row['COUNT(*)'];
$timep = 300 - (time() - $tp);
}
if($timep > 0){
    $error = 2;
    $mess = "Подождите $timep секунд";
    $fa = "error";
}


  if($promo == '') {
    $error = 1;
    $mess = "Введите промокод";
    $fa = "error";
  }
  if($count == 0) {
    $error = 2;
    $mess = "Промокод не найден";
    $fa = "error";
  }
 if($count != 0) {
    $sql_select1 = "SELECT * FROM promo WHERE name='$promo'";
$result1 = mysql_query($sql_select1);
$row = mysql_fetch_array($result1);
if($row)
{	
$sum = $row['sum'];
$limit = $row['active'];
$actived = $row['actived'];
$idactive = $row['id_active'];
}
  }
if($sum >1000) {
    $error = 2;
    $mess = "Сумма промокода больше чем должна быть";
    $fa = "error";
  }
  if($count == 1) {
  if($limit == $actived || $actived > $limit) {
    $error = 3;
    $mess = "Активации закончились";
    $fa = "error";
  }
  if($ban == 1) {
    $error = 4;
    $mess = "Ваш аккаунт заблокирован";
    $fa = "error";
  }
  }
  if (preg_match("/$user_id /",$idactive))  {	
	$error = 5;
    $mess = "Вы уже активировали этот код";
    $fa = "error";
   }
  if($error == 0) {
      $time = time();
$newbonus = $bonus +( $sum * 8);
    $newbalance = $balance + $sum;
    $newactive = $actived + 1;
    $newid = "$user_id $idactive";
    $update_sql1 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
$update_sql1 = "UPDATE users SET wager = $wager + $sum WHERE hash = '$sid' ";
    mysql_query($update_sql1);

  $update_sql1 = "UPDATE users SET bonus = '$newbonus' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    // обновляем бд (2)
    $update_sql2 = "UPDATE promo SET actived = '$newactive' WHERE name = '$promo'";
    mysql_query($update_sql2); 
    // обновляем бд (3)
    $update_sql3 = "UPDATE promo SET id_active = '$newid' WHERE name = '$promo'";
    mysql_query($update_sql3);
    $update_sql3 = "UPDATE users SET time_promo = '$time' WHERE hash = '$sid'";
    mysql_query($update_sql3);
    $fa = "success";
  }
  $res = array(
	'fa' => "$fa",
	'error' => "$mess",
	'balance' => "$balance",
	'new_balance' => "$newbalance",
	'sum' => "$sum"
    );
}

if($type == "deposit")
{
    $summa = $_POST['sum'];
  $promo = $_POST['promo'];
$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query( $sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $adm=$row['admin'];
    $login = $row['login'];
$bala = $row['balance'];
$user_id = $row['id'];
}


  if ($summa < 1) {
    $error = 1;
	$mess = "Минимальная сумма пополнения от 1р";
	$fa = "error";	
  }
  if (!is_numeric($summa)) {
    $error = 1;
	$mess = "Минимальная сумма пополнения от 1Р";
	$fa = "error";	
  }
 
  if($error == 0) {
  	$newactive = $actived + 1;
    $newid = "$user_id $idactive";
      $datas = date("d.m.Y");
	$datass = date("H:i:s");
	$data = "$datas $datass";
      $o = (($user_id * $summa + 105) * 105) * rand(1, 100);
      
     
    
	$insert_sql1 = "INSERT INTO `payments` (`user_id`, `suma`, `beforepay`, `status` , `description`, `transaction`, `data`) 
	VALUES ('{$user_id}', '{$summa}', '{$bala}', '1' , '{$login}', '{$o}', '{$data}');";
	mysql_query($insert_sql1);
  $fa = "success";
  
  $sql_select = "SELECT * FROM payments WHERE user_id='$user_id' ORDER BY id DESC";
$result = mysql_query( $sql_select);
$row = mysql_fetch_array($result);
if($row)
{	

$user = $row['id'];
}
  
}

$s = round($summa);


$api_key = 'eLME8rRVKwOhN1kaIdzPgBAZT665lxvm';


if(1 == 1){
    $url = 'https://gamepay.best/createOrder'; 
$params = array( 
'token' => $api_key, 
'unique_id' => $o, 
'amount' => $s, 
'shop_id'=>3,
'description' => 'Пополнение на сайте GameWin' 
); 
$result = file_get_contents($url, false, stream_context_create(array( 
'http' => array( 
'method' => 'POST', 

'content' => http_build_query($params) 
) 
))); 
$link1 = json_decode($result, true); 
$linkgo = $link1['data']['link']; 
}

if(0 == 1){

$url = 'https://api.swiftpay.ru/createOrder'; 
$params = array( 
'token' => $api_key, 
'order_id' => $o, 
'amount' => $s, 
'shop_id'=>326,
'description' => 'Пополнение на сайте GameWin' 
); 
$result = file_get_contents($url, false, stream_context_create(array( 
'http' => array( 
'method' => 'POST', 
'header' => 'Content-type: application/x-www-form-urlencoded', 
'content' => http_build_query($params) 
) 
))); 
$link1 = json_decode($result, true); 
$linkgo = $link1['data']['link']; 


}

    $res = array(
	'success' => "$fa",
	'error' => "$mess",
		'summa' => "$s",
'orderid' => "$o",
'link' => "$linkgo",
'system' => "1",
    );

}
if($type == "withdraw") {
$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
   // $wallet = $row['qiwi'];
     $time_w=$row['time_withdraw'];
    $vk_id = $row['vk_id'];
$wager = $row['wager'];
$user_id = $row['id'];
$login = $row['vk_name'];
$balance = $row['balance'];
}
$sql_select23 = "SELECT SUM(suma) FROM payments WHERE user_id='$user_id' and status=2";
$result23 = mysql_query($sql_select23);
$row = mysql_fetch_array($result23);
if($row)
{
$sumdep = $row['SUM(suma)'];
}
$sql_select24 = "SELECT COUNT(*) FROM withdraws WHERE user_id='$user_id' AND status=0";
$result24 = mysql_query($sql_select24);
$row = mysql_fetch_array($result24);
if($row)
{
$count = $row['COUNT(*)'];
}
if($sumdep == '') {
 $sumdep = 0; 
}
$system = $_POST['system'];
$wallet = $_POST['wallet'];
$sum = $_POST['sum'];
  if($system == "qiwi") {
      $ps = "qiwi";
    }
    if($system == "payeer") {
      $ps = "payeer";
    }
    if($system == "webmoney") {
      $ps = "wm";
    }
    if($system == "yandex") {
      $ps = "ya";
    }
    if($system != "qiwi" && $system != "payeer" && $system != "webmoney" && $system != "yandex") {
        $error = "77777";
        $mess = "Что-то пошло не так...";
        $fa = "error";
    }
$dwallet = strlen($wallet);
if($wallet == '' || $sum == '') {
  $error = 1;
  $mess = "Заполните все поля";
  $fa = "error";
}


if($sum > $balance) {
  $error = 2;
  $mess = "Недостаточно средств";
  $fa = "error";
}
  if($sum != '' && $wallet != '') {
if(!is_numeric($sum)) {
  $error = 4;
  $mess = "Введите корректную сумму";
  $fa = "error";
}
if($dwallet < 8 || $dwallet > 20) {
  $error = 5;
  $mess = "Кошелек от 8 до 20 символов";
  $fa = "error";
}
  
if($sum < $min_withdraw) {
  $error = 6;
  $mess = "Минимальная сумма вывода $min_withdraw р";
  $fa = "error";
}
if (!preg_match("#^[aA-zZ0-9\-_.]+$#",$sum)) 
{
    $mess = "Недопустимые символы в сумме";
    $fa = "error";
    $error = 7;
} 
if (!preg_match("#^[+0-9PpWw]+$#",$wallet)) 
{
    $mess = "Uncorrect wallet";
    $fa = "error";
    $error = 8;
}
if($sumdep < $dep_withdraw) {
    $mess = "Пополните баланс на $dep_withdraw руб.";
    $error = 9;
    $fa = "error";
  }
  if($count == 1) {
    $mess = "Не разбивайте на несколько выплат";
    $error = 10;
    $fa = "error";
  }
  }
  
  
  
  if($error == 0) {
    $summ = round($sum, 2);
    $summm = round(($summ / 100) * (100 - $commission), 2); // берем % с вывода
    $newbalance = $balance - $sum;
    $datas = date("d.m.Y");
    $datass = date("H:i:s");
    $data = "$datas $datass";
    $time = time();
  mysql_query("UPDATE users SET time_withdraw = '$time' WHERE hash = '$sid'");
 
   

    
    
    $insert_sql11 = "INSERT INTO `withdraws` (`id`, `user_id`, `ps`, `wallet`, `sum`, `date`, `status`, `no_comm`) VALUES (NULL, '$user_id', '$ps', '$wallet', '$summm', '$data', '$st', '$summ');";
    mysql_query( $insert_sql11); 
    $update_sql1 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $fa = "success";
}
  $res = array(
    'success' => "$fa",
    'error' => "$mess",
    'balance' => "$balance",
    'new_balance' => "$newbalance"
    );
}

if($type == "daily") {
$sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{   
$bdate = $row['bdate'];
$balance = $row['balance'];
}
$time = time();
$rnd = rand(100, 300) / 100;
$f_time = $time - $bdate;
$w_time = 86400 - $f_time;
$newbalance = $balance + $rnd;
$seconds = $w_time; // Количество исходных секунд
$minutes = floor($seconds / 60); // Считаем минуты
$hours = floor($minutes / 60); // Считаем количество полных часов
$minutes = $minutes - ($hours * 60);  // Считаем количество оставшихся минут
$sec = $seconds % 60;

$w__time = $hours.':'.$minutes.':'.$sec; // Получаем время например - 12:34:56
if(empty($sid)) {
    $error = 2;
    $status = "error";
    $mess = "Необходимо авторизоваться";
}
if($f_time < 86400) {
    $error = 1;
    $status = "error";
    $mess = "До следующего бонуса осталось $w__time";
} 




	
if($error == 0) {
    $upd_bal = mysql_query( "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'");
    $upd_time = mysql_query( "UPDATE users SET bdate = '$time' WHERE hash = '$sid'");
    $gift_mess = "Получено в раздаче <b>$rnd р</b>";
    $status = "success";
}
$res = array('fa' => "$status", 'error' => "$mess", 'newbalance' => "$newbalance", 'gift' => "$gift_mess");
}


if($type == "deletewithdraw") {
  $id_delete = $_POST['del'];
$sql_select2 = "SELECT * FROM users WHERE hash='$sid'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{

$user_id = $row['id'];
$login = $row['login'];
$balance = $row['balance']; 
$balancewithdraw = $row['balancewithdraw'];
    
}
$sql_select3 = "SELECT * FROM withdraws WHERE id='$id_delete'";
$result3 = mysql_query($sql_select3);
$row = mysql_fetch_array($result3);
if($row)
{
$user_id_w = $row['user_id'];
$sum = $row['no_comm'];
$status = $row['status'];
}
$sql_select4 = "SELECT COUNT(*) FROM withdraws WHERE id='$id_delete'";
$result4 = mysql_query($sql_select4);
$row = mysql_fetch_array($result4);
if($row)
{
$count = $row['COUNT(*)'];
}
if($count == 0) {
   $error = 777;
   $mess = "Выплата не найдена";
   $fa = "error";
} else {
if($status != 0) {
   $error = 1;
   $mess = "Статус выплаты уже изменен";
   $fa = "error";
}
if($user_id != $user_id_w) {
   $error = 2;
   $mess = "Вы не можете отменить чужую выплату";
   $fa = "error";
}
} 

  if($error == 0) {
    $delete = "DELETE FROM `withdraws` WHERE id = '$id_delete'";
mysql_query($delete);
  $newbalance = $balance + $sum;
    $update_sql1 = "UPDATE users SET balance = '$newbalance' WHERE hash = '$sid'";
    mysql_query($update_sql1);
    $fa = "success";
  
      

  }
  $res = array(
    'success' => "$fa",
    'error' => "$mess",
    'balance' => "$balance",
    'new_balance' => "$newbalance"
    );
}
if($type == "banUser") {
  $id = $_POST['id'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
  $sql_select2 = "SELECT * FROM users WHERE id='$id'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$ban = $row['ban']; 
}

if($ban == 0) {
  $query = mysql_query("UPDATE users SET ban = '1' WHERE id = '$id'"); 
  $smess = "Пользователь заблокирован";
  $ban_type = "success";
  $fas = '<i class="fa fa-unlock" aria-hidden="true"></i>';
  $title = "Разблокировать";
}
if($ban == 1) {
  $query = mysql_query("UPDATE users SET ban = '0' WHERE id = '$id'"); 
  $smess = "Пользователь разблокирован";
  $ban_type = "danger";
  $fas = '<i class="fa fa-lock" aria-hidden="true"></i>';
  $title = "Заблокировать";
}
$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess",
    'smess' => "$smess",
    'type' => "$ban_type",
    'lock' => "$fas",
    'title' => "$title",
    'id' => "$id"
    );
}
if($type == "edit") {
  $id = $_POST['id'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
  $sql_select2 = "SELECT * FROM users WHERE id='$id'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$login = $row['login'];
$balance = $row['balance'];
$vk = $row['hash']; 
}
$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess",
    'login' => "$login",
    'balance' => "$balance",
    'vk' => "$vk",
    'id' => "$id"
    );
}
if($type == "banm") {
  $id = $_POST['id'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
  $sql_select2 = "SELECT * FROM users WHERE id='$id'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$login = $row['login'];
$balance = $row['balance'];
$ban = $row['ban']; 
$whyban= $row['whyban'];
}

if($ban == 1){
   
    $status_ban = 'Нет';
     $ban = 0;
}else{
   
    $status_ban = 'Да'; 
     $ban = 1;
}
$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess",
    'status_ban' => "$status_ban",
    'whyban' => "$whyban",
    'vk' => "$login",
    'id' => "$id"
    );
}


if($type == "adduser") {
  $link = $_POST['link'];
  $act = $_POST['act'];
  $profile = $_POST['profile'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if($link == '' || $act == '' || $profile == '') {
    $error = 2;
    $mess = "Заполните все поля";
    $fa = "error";
}

  $sql_select2 = "SELECT * FROM partners WHERE vk_group='$link'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$error = 2;
    $mess = "Группа уже есть в базе данных";
    $fa = "error";
    
}

if($error == 0) {
    $a = str_replace("https", "http", $profile);
    $sql_select2 = "SELECT * FROM users WHERE hash='$a'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
    $vk_id = $row['vk_id'];
    $login = $row['vk_name'];
    $partner = $row['partner'];
    
}
mysql_query("UPDATE users set partner=$partner + 1 WHERE hash='$a'");
 $insert_sql1 = "INSERT INTO `partners` ( `vk_id`,`login`, `vk_group`, `act`, `profile`)
                                VALUES ( '$vk_id','$login', '$link', '$act', '$profile')";
    mysql_query($insert_sql1);

$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess",
    'status_ban' => "$status_ban",
    'whyban' => "$whyban",
    'vk' => "$login",
    'id' => "$id"
    );
}


if($type == "getpromo") {
  
  $dayp = date('d');
  
   $sql_select = "SELECT * FROM users WHERE hash='$sid'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
if($row)
{	
    $post = $row['post'];
    $vk_name = htmlspecialchars($row['vk_name']);
    $balancewithdraw = $row['balancewithdraw'];
$daypromo = $row['daypromo'];
$partner = $row['partner'];
}


if($post == 1) {
    $error = 2;
    $mess = "Введите ссылку на пост";
    $fa = "error";
}

if($partner < 1) {
    $error = 2;
    $mess = "Ошибка";
    $fa = "error";
}


if($daypromo == $dayp) {
    $error = 2;
    $mess = "Вы сегодня уже получали промокод";
    $fa = "error";
}
if($error == 0) {
    $sql_select22 = "SELECT * FROM partners WHERE login='$vk_name'";
$result202 = mysql_query($sql_select22);


$p = [];

while($row = mysql_fetch_array($result202)) {
 
$id = $row['id'];
$promo  = rand(10000,90000) + rand(100,900) + rand(1000,9000)/100;
$promo = round($promo);
array_push($p, $promo);
$count += 1;
mysql_query("UPDATE partners set promo='$promo' WHERE id='$id'");

 $insert_sql1 = "INSERT INTO `promo` (`id`, `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$promo', '2', '20', '0', '');";
}
//mysql_query("UPDATE users set post=1 WHERE hash='$sid'");

 
    mysql_query($insert_sql1);
mysql_query("UPDATE users set daypromo=$dayp WHERE hash='$sid'");
 //$insert_sql1 = "INSERT INTO `partners` ( `vk_id`,`login`, `vk_group`, `act`, `profile`)
   //                             VALUES ( '$vk_id','$login', '$link', '$act', '$profile')";
//    mysql_query($insert_sql1);

$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess",
    'dayp' => "$dayp",
    'count' => "$count",
    'vk' => "$login",
    'promo' => json_encode($p)
    );
}


if($type == "save") {
  $id = $_POST['id'];
  $balance = $_POST['balance'];
  $login = $_POST['login'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
$query = mysql_query( "UPDATE users SET login = '$login', balance ='$balance' WHERE id = '$id'");
$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess"
   
    );
}

if($type == "saveban") {
  $id = $_POST['id'];
  $whyban = $_POST['whyban'];
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
$query = mysql_query( "UPDATE users SET whyban = '$whyban' WHERE id = '$id'");
$fa = "success";
}
$res = array(
    'fa' => "$fa",
    'error' => "$mess"
   
    );
}
if($type == "edit_payout") {
   $id = $_POST['id'];
   $status = $_POST['status'];
   
  if(!$_SESSION['admin_auth']) {
    $error = 1;
    $mess = "Вы точно админ ?";
    $fa = "error";
}
if(!is_numeric($id)) {
    $error = 2;
    $mess = "!is_numeric ID";
    $fa = "error";
}
if($error == 0) {
  if($status == "send") {
       $sql_select2 = "SELECT * FROM withdraws WHERE id='$id'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
    $wallet = $row['wallet'];
$user_id = $row['user_id'];
$sum = $row['sum']; 
}
$sql_select3 = "SELECT * FROM users WHERE id='$user_id'";
$result3 = mysql_query($sql_select3);
$row = mysql_fetch_array($result3);
if($row)
{
    $vk_id = $row['vk_id'];
$login = $row['vk_name']; 
}
      $support_vk->sendMessage($chat_id, "✅Выплата 
     суммой $sum р была успешно отправлена пользователю $login"); // Отправляем ответ
      $support_vk->sendMessage($vk_id, "✅Выплата 
     суммой $sum р была успешно отправлена на ваш кошелек $wallet"); // Отправляем ответ
$query = mysql_query( "UPDATE withdraws SET status = '1' WHERE id = '$id'");
  }

  if($status == "back") {
 $sql_select2 = "SELECT * FROM withdraws WHERE id='$id'";
$result2 = mysql_query($sql_select2);
$row = mysql_fetch_array($result2);
if($row)
{
$user_id = $row['user_id'];
$sum = $row['no_comm']; 
}
$sql_select3 = "SELECT * FROM users WHERE id='$user_id'";
$result3 = mysql_query($sql_select3);
$row = mysql_fetch_array($result3);
if($row)
{
$balance = $row['balance']; 
}
$newbalance = $balance + $sum;
$query = mysql_query( "UPDATE withdraws SET status = '2' WHERE id = '$id'");
$query1 = mysql_query( "UPDATE users SET balance = '$newbalance' WHERE id = '$user_id'");
  }
  $fa = "success";
}

$res = array(
    'fa' => "$fa",
    'error' => "$mess"
   
    );
}
if($type == "createpromo") {

$name = $_POST['createname'];
$sum = $_POST['createsum'];
$act = $_POST['createactive'];
$sql_select4 = "SELECT COUNT(*) FROM promo WHERE name='$name'";
$result4 = mysql_query($sql_select4);
$row = mysql_fetch_array($result4);
if($row)
{
$count = $row['COUNT(*)'];
}
if($name == '' || $sum == '' || $act == '') {
  $error = 1;
  $mess = "Заполните все поля";
  $fa = "error";
}
if(!$_SESSION['admin_auth']) {
    $error = 2;
    $mess = "Вы точно админ ?";
    $fa = "error";
}

  if($name != '' && $sum != '' && $act != '') {
  if($sum > 60) {
  $error = 6;
  $mess = "Сумма промокода должна быть меньше 60";
  $fa = "error";
}

  if($sum < 1) {
  $error = 4;
  $mess = "Сумма от 1";
  $fa = "error";
}
  if($act < 1) {
  $error = 5;
  $mess = "Кол-во от 1";
  $fa = "error";
}

  if(!is_numeric($sum)) {
  $error = 6;
  $mess = "Сумма цифрами";
  $fa = "error";
}
  if(!is_numeric($act)) {
  $error = 7;
  $mess = "Кол-во цифрами";
  $fa = "error";
}
  if (!preg_match("#^[а-яА-ЯaA-zZ0-9\-_]+$#",$name)) {
   $error = 8;
   $mess = "Недопустимые символы";
   $fa = "error";
}   
  if($count > 0) {
  $error = 9;
  $mess = "Промокод уже существует";
  $fa = "error";
}
if (explode( '.', $act)[1]) {
    $error = 10;
  $mess = "Ошибка при создании";
  $fa = "error";
}
}
  if($error == 0) {
    $datas = date("d.m.Y");
  $datass = date("H:i:s");
  $data = "$datas $datass";
  $newbalance = $balance - ($sum * $act);
  $insert_sql1 = "INSERT INTO `promo` (`id`, `name`, `sum`, `active`, `actived`, `id_active`) VALUES (NULL, '$name', '$sum', '$act', '0', '');";
    mysql_query($insert_sql1);

    $fa = "success";
}
$res = array(
  'fa' => "$fa",
  'error' => "$mess"
    );
}
  echo json_encode($res);

?>