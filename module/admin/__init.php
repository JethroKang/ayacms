<?php


strlen($P[0])<1 && $P[0]='index';
define('ACTION',$P[0]);


define('RMA',RM.ACTION.'/');






set_val('theme_file',ACTION=='login'?'login.php':'admin.php');
if(ACTION=='logout' or ACTION=='login')
	return;

if(empty($BPV[2])){
	yun_msg('','无管理权限',url(R.'admin/login/'));
}



?>