<?php
if(IS_POST){
	
	$pvs=(array)$_POST['pvs'];
	$arr=array (
			'pvs'=>serialize($pvs) 
	);
	
	$str=sql_update($arr);
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('设置成功');
}

