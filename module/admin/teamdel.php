<?php

if(IS_POST){
	$ids=$_POST['ids'];
	is_array($ids) or yun_error('至少选择一项');
	foreach($ids as $id){
		$id=abs(intval($id));
		if(!isset($C['sys_teams'][$id])||$id<5)
			continue;
		unset($C['sys_teams'][$id]);
	}
	set_conf('sys_teams',$C['sys_teams']);
	yun_succeed('删除成功','refresh');
}
$id=(int)$_GET['id'];
isset($C['sys_teams'][$id]) or yun_error('用户组不存在');
$id<5&&yun_error('系统集成,无法删除');
unset($C['sys_teams'][$id]);
set_conf('sys_teams',$C['sys_teams']);
yun_succeed('删除成功','refresh');
?>