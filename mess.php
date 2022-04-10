<?php
  session_start();
$sid = $_SESSION['hash'];

require("config.php");

$r = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM messages"));
$frm = $r['MAX(id)'];
$f = $frm - 20;
$sql = "SELECT * FROM messages WHERE id > $f ORDER BY id ASC"; //выборка всего
        $result = mysql_query($sql) or die(mysql_error());
        while ($rows = mysql_fetch_array($result)):
            $admin_mess = $rows['admin_mess'];

            $promo = $rows['promo'];
            $text_promo = $rows['text_promo'];
             $active_promo = $rows['active_promo'];
            $sum_promo = $rows['sum_promo'];

            $rain = $rows['rain'];
            
$quiz = $rows['quiz'];
$question = $rows['question'];
$answer = $rows['answer'];
$priz = $rows['priz'];
$winner = $rows['winner'];
            $id1 = $rows['id'];
            $name = $rows['name'];
            $img  = $rows['img'];
            $text = $rows['text'];


$sql1 = "SELECT * FROM users WHERE hash = '$sid'"; //выборка всего
        $result1 = mysql_query($sql1) or die(mysql_error());
$rows1 = mysql_fetch_array($result1);
$admin = $rows1['admin'];
$ban = $rows1['chat_ban'];
if($admin == 1 or $admin == 2){
    $admm = '<div class="row"><div class="col"><button onclick="ban('.$name.')" class="btn btn-theme btn-sm w-100"><i class="fa fa-lock"></i></button></div><div class="col"><button onclick="del_msg('.$id1.')" class="btn btn-theme btn-sm w-100"><i class="fa fa-trash-o"></i></button></div></div>';
}

$style = 'animation: none!important;';
							            if ($id1 == $frm){
							            	$style = '';
							            }

 if($admin_mess == 1){
    $mess = '
    <div class="msg" style="'.$style.'">
        <div class="avatar">
                <img style="border: 0px;border: 2px solid #b7201f;" draggable="false" alt="" src="'.$img.'">
        		<!---->
        </div>
        <div class="msg-block" style="width:100%">
                <div onclick="var u = $(this); $(`.inamel`).val(u.text() + `, `); return false;" class="nameyt d-flex"  >'.$name.'</div>
                <div class="text" style="
                word-break: break-all;
                ">
                        '.$text.'
                        <!---->
                </div>
                 '.$admm.'
        </div>
</div>

    
     
   ';
} else if($admin_mess == 2){
    $mess = '
    	<div class="msg" style="'.$style.'">
        <div class="avatar">
                <img style="border: 0px;border: 2px solid #1cc345;" draggable="false" alt="" src="'.$img.'">
        		<!---->
        </div>
        <div class="msg-block" style="width:100%">
                <div class="modname  d-flex" onclick="var u = $(this); $(`.inamel`).val(u.text() + `, `); return false;" >'.$name.'</div>
                <div class="text" style="
                word-break: break-all;
                ">
                        '.$text.'
                        <!---->
                </div>
                 '.$admm.'
        </div>
</div>
							
							
      
   ';
} else if($admin_mess == 3){
    $mess = '
    	<div class="msg" style="'.$style.'">
        <div class="avatar">
                <img style="border: 0px;border: 0px solid #1cc345;" draggable="false" alt="" src="'.$img.'">
        		<!---->
        </div>
        <img class="ytico" draggable="false" alt="" src="youtube.png">
        <div class="msg-block" style="width:100%">
                <div class="nameyt  d-flex" onclick="var u = $(this); $(`.inamel`).val(u.text() + `, `); return false;" >'.$name.'</div>
                <div class="text" style="
                word-break: break-all;
                ">
                        '.$text.'
                        <!---->
                </div>
                 '.$admm.'
        </div>
</div>
							
							
      
   ';
}

else{
        
   

$mess = '
 	<div class="msg" style="'.$style.'">
        <div class="avatar">
                <img style="border: 0px;" draggable="false" alt="" src="'.$img.'">
        		<!---->
        </div>
        <div class="msg-block" style="width:100%">
                <div class="name d-flex" onclick="var u = $(this); $(`.inamel`).val(u.text() + `, `); return false;" style="cursor:pointer;">'.$name.' </div>
                <div class="text" style="
                word-break: break-all;
                ">
                        '.$text.'
                        <!---->
                </div>
                 '.$admm.'        
        </div>

</div>
							';
    
}


    echo $mess;
            
            endwhile; 

?>
