<?php

$id=(int)$_GET['id'];
isset($C['sys_teams'][$id]) or yun_error('用户组不存在');
$team=$C['sys_teams'][$id];

if(IS_POST){
	$name=trim((string)$_POST['name']);
		$pvs=is_array($_POST['pvs'])?$_POST['pvs']:array();
	
	strlen($name)<1&&yun_error('身份名不能为空','yun_onfocus("name");');
	
	$C['sys_teams'][$id]=array('name'=>$name,'pvs'=>$pvs);
	set_conf('sys_teams',$C['sys_teams']);
	yun_succeed('编辑成功','f');
}
?>