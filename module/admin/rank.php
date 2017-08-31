<?php

set_val('current_mainmenu_title','general');
set_val('current_mainmenu_list','general_'.ACTION);



if(IS_POST){
	$_conf=include (ABSPATH.'static/config.php');
	$arr=array_intersect_key($_POST,$_conf);
	
	
	$_a=abs(intval($_POST['sys_lv_a'][2]));
	$_b=abs(intval($_POST['sys_lv_b'][2]));
	$_c=abs(intval($_POST['sys_lv_c'][2]));
	$_a<1&&$_a=1;
	$_b<1&&$_b=1;
	$_c<1&&$_c=1;
	$arr['sys_lv_a']=array(abs(intval($_POST['sys_lv_a'][0])),!empty($_POST['sys_lv_a'][1]),$_a);
	$arr['sys_lv_b']=array(abs(intval($_POST['sys_lv_b'][0])),!empty($_POST['sys_lv_b'][1]),$_b);
	$arr['sys_lv_c']=array(abs(intval($_POST['sys_lv_c'][0])),!empty($_POST['sys_lv_c'][1]),$_c);
	
	
	foreach($arr as $k=>$v){
		set_conf($k,$v);
	}
	
	
	
	admin::upcache();
	yun_succeed('提交成功');
}

?>