<?php

set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);

if(IS_POST){
	$_conf=include (ABSPATH.'static/config.php');
	$arr=array_intersect_key($_POST,$_conf);
	foreach($arr as $k=>$v){
		set_conf($k,$v);
	}
	admin::upcache();
	yun_succeed('提交成功','f');
}

