<?php
if(IS_POST){
	$tochannel=(int)$_GET['tochannel'];
	
	$ids=$_POST['ids'];
	empty($tochannel)&&yun_error('请选择目标');
	is_array($ids) or yun_error('至少选择一项');
	if($G['channels'][$tochannel]['formod']!=$mod)
		yun_error('目标栏目非相同模型');
	foreach($ids as $pid){
		picture::topic_move($pid,$tochannel);
	}
	yun_succeed('移动成功','f');
}


