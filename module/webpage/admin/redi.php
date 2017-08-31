<?php
$channel=$G['channels'][$id];

$theme_files=array ();
if($_d=@opendir(ABSPATH.'theme/'.$C['sys_theme'].'/')){
	while($entry=readdir($_d)){
		if(!in_array(substr($entry,0,1),array (
				'.',
				'_' 
		))&&substr($entry,-4)=='.php'&&is_file(ABSPATH.'theme/'.$C['sys_theme'].'/'.$entry)){
			$theme_files[]=$entry;
		}
	}
	closedir($_d);
}

if(IS_POST){
	$arr=array ();
	$arr['theme_tpl']=$_POST['theme_tpl'];
	
	$str=sql_update($arr);
	
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('提交成功','f');
}
