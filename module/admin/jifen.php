<?php

set_val('current_mainmenu_title','general');
set_val('current_mainmenu_list','general_'.ACTION);



if(IS_POST){
	$_conf=include (ABSPATH.'static/config.php');
	$arr=array_intersect_key($_POST,$_conf);
	
	
	$arr['sys_t_a']=abs(intval($_POST['sys_t_a']));
	$arr['sys_t_b']=abs(intval($_POST['sys_t_b']));
	$arr['sys_t_c']=abs(intval($_POST['sys_t_c']));
	$arr['sys_r_a']=abs(intval($_POST['sys_r_a']));
	$arr['sys_r_b']=abs(intval($_POST['sys_r_b']));
	$arr['sys_r_c']=abs(intval($_POST['sys_r_c']));
	
	
	foreach($arr as $k=>$v){
		set_conf($k,$v);
	}
	
	
	
	admin::upcache();
	yun_succeed('提交成功');
}

?>