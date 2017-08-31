<?php
$id=(int)$_GET['id'];

if(IS_POST){
	$formod=trim($_POST['formod']);
	$name=trim($_POST['name']);
	$sign=trim($_POST['sign']);
	
	empty($formod)&&yun_error('模型未指定');
	module_exists($formod) or yun_error('模型不存在');
	
	$_name=strip_tags($name);
	strlen($name)!=strlen($_name)&&yun_error('栏目名称含有非法字符');
	strlen($name)<1&&yun_error('栏目名称不能为空','yun_onfocus("name");');
	
	strlen($sign)<1&&yun_error('链接标识不能为空','yun_onfocus("sign");');
	preg_match('/^\w+$/is',$sign) or yun_error('链接标识含有非法字符','yun_onfocus("sign");');
	str_is_int($sign)&&yun_error('链接标识不能全为数字');
	
	foreach($G['channels'] as $k=>$v){
		if($v['sign']==$sign)
			yun_error('链接标识已使用','yun_onfocus("sign");');
	}
	
	$arr=array (
			'formod'=>$formod,
			'name'=>$name,
			'sign'=>$sign,
			'o'=>intval($_POST['order']),
			'pid'=>intval($_POST['pid']),
			'hide'=>0,
			'keywords'=>'',
			'description'=>'' 
	)
	;
	
	if(!class_exists($formod)||!method_exists($formod,'channel_new')){
		yun_error('缺少成员函数');
	}
	
	eval("$formod::channel_new(\$arr);");
	admin::upcache();
	yun_succeed('创建成功','f');
}

$arr=$G['channels'];
$arr=array_pop($arr);
$order=++$arr['o'];

$sign=strrand();

?>