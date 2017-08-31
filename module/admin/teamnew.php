<?php

if(IS_POST){
	for($newid=4;isset($C['sys_teams'][$newid]);$newid++)
		;
		$name=trim((string)$_POST['name']);
		$pvs=is_array($_POST['pvs'])?$_POST['pvs']:array();
		
	strlen($name)<1&&yun_error('身份名不能为空','yun_onfocus("name");');
	
	$C['sys_teams'][$newid]=array('name'=>$name,'pvs'=>$pvs);
	set_conf('sys_teams',$C['sys_teams']);
	yun_succeed('创建成功','f');
}
?>