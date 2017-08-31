<?php
$tabs=$G['tabs'];

foreach($G['tabs'] as $k=>$v){
	if($v['fortab']!='picture')
		unset($tabs[$k]);
}

// 所有tabtpl
$d=dir($path=ABSPATH.'module/picture/tab_tpl');
$dirnames=array ();
while(false!==($entry=$d->read())){
	if($entry!='.'&&$entry!='..'&&is_dir($path.'/'.$entry))
		$dirnames[]=$entry;
}
$d->close();

$tabfiles=array ();
foreach($dirnames as $dirname){
	$d=dir($path=ABSPATH.'module/picture/tab_tpl/'.$dirname);
	
	while(false!==($entry=$d->read())){
		if($entry!='.'&&$entry!='..'&&is_file($path.'/'.$entry))
			$tabfiles[$dirname][]=$entry;
	}
	$d->close();
}

$diss=$G['channels'][$id]['tabs']['diss'];
$tpls=$G['channels'][$id]['tabs']['tpls'];

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
			'tabs'=>serialize(array (
					'diss'=>$diss,
					'tpls'=>$tpls 
			)) 
	);
	
	$str=sql_update($arr);
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('提交成功','f');
}