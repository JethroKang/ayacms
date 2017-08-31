<?php


set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_'.ACTION);

if(IS_POST){
	$arr=array();
	foreach($C['install_mods'] as $v){
		$arr[(int)$_POST['order'][$v]][]=$v;
	}
	ksort($arr);
	$C['install_mods']=array();
	foreach($arr as $v){
		foreach($v as $val){
			$C['install_mods'][]=$val;
		}
	}
	
	set_conf('install_mods');
	yun_succeed('提交成功','f');
}

$mods=$C['install_mods'];

//print_r($mods);

$d=dir(ABSPATH.'module');
while(false!==($entry=$d->read())){
	if(in_array($entry,$C['install_mods']))
		continue;
	if(in_array(substr($entry,0,1),array('_','.')))
					continue;
	$mods[]=$entry;
	
}
$d->close();


set_val('apply_stop',true);
foreach($mods as $mod){
$allmods[$mod]=include (ABSPATH.'module/'.$mod.'/__conf.php');
}
set_val('apply_stop',false);



foreach($allmods as $k=>$v){
	$allmods[$k]['is_install']=!module_exists($k)&&file_exists(ABSPATH.'module/'.$k.'/admin/install.php');
	$allmods[$k]['is_uninstall']=module_exists($k)&&file_exists(ABSPATH.'module/'.$k.'/admin/uninstall.php');
	$allmods[$k]['order']=(int)$_POST['order'][$k];
}

?>