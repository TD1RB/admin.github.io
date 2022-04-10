<?php

require("inc/config.php");


$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$idpayment = $json_obj['order_id'];
$update_sql2 = "SELECT * FROM payments  WHERE transaction = '$idpayment'";
$u = mysql_query($update_sql2);
$status = $u['status'];

if ($status != 2){

$idpayment = $json_obj['order_id'];
$status = 2;
$update_sql2 = "UPDATE payments SET status = '$status' WHERE transaction = '$idpayment'";
mysql_query($update_sql2);





$sql_select2 = "SELECT * FROM payments WHERE transaction='$idpayment'";
$result2 = mysql_query($sql_select2);
$row2 = mysql_fetch_array($result2);
if($row2)
{

$user_id = $row2['user_id'];
$summa = $row2['suma'];

}

$sql_select3 = "SELECT * FROM users WHERE id='$user_id'";
$result3 = mysql_query($sql_select3);
$row3 = mysql_fetch_array($result3);
if($row3)
{
$balance = $row3['balance'];
$ref = $row3['ref_id'];
}

$sumforadd = $balance + $summa;


$update_sql3 = "UPDATE users SET balance = '$sumforadd' WHERE id = '$user_id'";
mysql_query($update_sql3);



       	$sumaref = ($summa / 100) * 10;
       	
       	
if($ref > 0)
{
	$sql_select1 = "SELECT * FROM users WHERE id='$ref'";
$result1 = mysql_query($sql_select1);
$row1 = mysql_fetch_array($result1);
if($row1)
{	
$balanceref = $row1['balance'];
$balancerefs = $balanceref + $sumaref;
$update_sql12 = "Update users set balance='$balancerefs' WHERE id='$ref'";
    mysql_query($update_sql12);
   
}
} }

?>