<?php
require("config.php");
session_start();
$sid = $_SESSION['hash'];
$sql_select5 = "SELECT COUNT(*) FROM users WHERE online=1";
$result5 = mysql_query($sql_select5);
$row2 = mysql_fetch_array($result5);
$online = $row2['COUNT(*)'];
$sql_select = "SELECT * FROM kot_games ORDER BY `id` DESC LIMIT 15";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);
do
{
	
	$id_g = $row['id'];
    $games_g = $row['game'];
    $bet_g = round($row['sum'], 2);
    $login_g = $row['login'];
    $win_s = round($row['win_summa'], 2);
    $type_g = $row['type'];
    if($type_g == 'win'){
    	$color_g = 'success';
    }else{
    	$color_g = 'danger';
    }
                                            		
 
	
$login = ucfirst($row['login']);
	$game =  <<<HERE
$game
<tr>
    <td>$games_g</td>
    <td>$login_g</td>
     <td>$bet_g</td>
    <td>
       <span class="text-$color_g">$win_s</span>
     </td>
</tr>
                                                


HERE;
$st = "";
$sts = "";
$login = "";
}
while($row = mysql_fetch_array($result));
$time = time() + 5;
$update_sql111 = "Update users set online='1', online_time='$time' WHERE hash='$sid'";
    mysql_query($update_sql111) or die("" . mysql_error());
	
	$sql_select = "SELECT COUNT(*) FROM users WHERE online='1'";
$result = mysql_query($sql_select);
$row = mysql_fetch_array($result);

$online_default = $row['COUNT(*)'];
$online = $online_default + $online_fake;
    $result = array(
	'game' => "$game",
    'online' => "$online"
    );
	
    echo json_encode($result);
?>