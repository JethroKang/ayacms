<?php
set_val('current_mainmenu_title','weihu');
set_val('current_mainmenu_list','weihu_user');

$tabs=$G['tabs'];

foreach($G['tabs'] as $k=>$v){
	if($v['fortab']!='user')
		unset($tabs[$k]);
}

// 所有tabtpl
$d=dir($path=ABSPATH.'module/admin/tab_tpl');
$dirnames=array ();
while(false!==($entry=$d->read())){
	if($entry!='.'&&$entry!='..'&&is_dir($path.'/'.$entry))
		$dirnames[]=$entry;
}
$d->close();

$tabfiles=array ();
foreach($dirnames as $dirname){
	$d=dir($path=ABSPATH.'module/admin/tab_tpl/'.$dirname);
	
	while(false!==($entry=$d->read())){
		if($entry!='.'&&$entry!='..'&&is_file($path.'/'.$entry))
			$tabfiles[$dirname][]=$entry;
	}
	$d->close();
}

$diss=$C['user_tabs']['diss'];
$tpls=$C['user_tabs']['tpls'];

if(IS_POST){
	$diss=(array)$_POST['diss'];
	$tpls=(array)$_POST['tpls'];
	
	// 排序
	$o=(array)$_POST['o'];
	asort($o);
	$arr=array ();
	foreach($o as $k=>$v){
		if(in_array($k,$diss))
			$arr[]=$k;
	}
	$diss=$arr;
	
	foreach($diss as $k=>$v){
		if(!isset($tabs[$v]))
			unset($diss[$k]);
	}
	
	foreach($tpls as $k=>$v){
		if(!isset($tabs[$k]))
			unset($tpls[$k]);
	}
	
	$arr=array (
			'diss'=>$diss,
			'tpls'=>$tpls 
	);
	
	set_conf('user_tabs',$arr);
	
	yun_succeed('提交成功','f');
}