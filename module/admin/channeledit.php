<?php
$id=intval($_GET['id']);

isset($G['channels'][$id]) or yun_error('栏目不存在');
$channel=$G['channels'][$id];

if(IS_POST){
	$formod=trim($_POST['formod']);
	$name=trim($_POST['name']);
	$sign=trim($_POST['sign']);
	
	empty($formod)&&yun_error('属性未指定');
	module_exists($formod) or yun_error('模型不存在');
	
	$_name=strip_tags($name);
	count($name)!=count($_name)&&yun_error('栏目名称含有非法字符');
	
	strlen($sign)<1&&yun_error('链接标识不能为空','yun_onfocus("sign");');
	preg_match('/^\w+$/is',$sign) or yun_error('链接标识含有非法字符','yun_onfocus("sign");');
	str_is_int($sign)&&yun_error('链接标识不能全为数字');
	
	foreach($G['channels'] as $k=>$v){
		if($v['sign']==$sign&&$id!=$k)
			yun_error('链接标识已使用','yun_onfocus("sign");');
	}
	
	$arr=array (
			'formod'=>$formod,
			'name'=>$name,
			'sign'=>$sign,
			'o'=>intval($_POST['order']),
			'pid'=>intval($_POST['pid']) 
	);
	
	if($channel['formod']==$formod){
		
		if(!class_exists($formod)||!method_exists($formod,'channel_edit')){
			yun_error('缺少成员函数:'.$formod);
		}
		
		eval("$formod::channel_edit(\$id,\$arr);");
	}else{
		
		if(!class_exists($channel['formod'])||!method_exists($channel['formod'],'channel_del')){
			yun_error('缺少成员函数:'.$channel['formod']);
		}
		if(!class_exists($formod)||!method_exists($formod,'channel_new')){
			yun_error('缺少成员函数:'.$formod);
		}
		
		eval("$channel[formod]::channel_del(\$id);");
		$DB->query('delete from '.PF.'channel where id='.$id);
		unset($G['channels'][$id]);
		eval("$formod::channel_new(\$arr);");
	}
	admin::upcache();
	yun_succeed('编辑成功','f');
}

// $channel=array_map('html',$channel);
extract($channel);

?>