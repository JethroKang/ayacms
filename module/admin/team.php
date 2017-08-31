<?php
set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);


$arr=array();
foreach($C['sys_teams'] as $k=>$v){
	$rs=$DB->query("select id from ".PF."user where team='$k'");
	$arr[$k]=$DB->num_rows($rs);
	
}
?>