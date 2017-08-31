<?php
if(isset($_GET['new'])){
	
	if(IS_POST){
		
		$cats=$G['channels'][$id]['cats'];
		
		if(count($cats)>2)
			yun_error('分类数量超过限制');
		
		$name=trim($_POST['name']);
		$subname=trim($_POST['subname']);
		
		if(strlen($name)<1)
			yun_error('请填写分类名称','yun_onfocus("name");');
		if(strlen($subname)<1)
			yun_error('请填写子分类名称','yun_onfocus("subname");');
		
		for($i=0;isset($cats[$i]);$i++)
			;
		
		$cats[$i]=array (
				'id'=>$i,
				'name'=>$name,
				'subnames'=>explode(',',$subname) 
		);
		
		$arr=array (
				'cats'=>serialize($cats) 
		);
		
		$str=sql_update($arr);
		$DB->query("update ".PF."channel set $str where id='$id'");
		
		yun_succeed('设置成功','f');
	}
}

if(isset($_GET['edit'])){
	$oid=(int)$_GET['oid'];
	$cats=$G['channels'][$id]['cats'];
	
	if(!isset($cats[$oid]))
		yun_error('参数错误');
	
	if(IS_POST){
		
		$name=trim($_POST['name']);
		$subname=trim($_POST['subname']);
		
		if(strlen($name)<1)
			yun_error('请填写分类名称','yun_onfocus("name");');
		if(strlen($subname)<1)
			yun_error('请填写子分类名称','yun_onfocus("subname");');
		
		$cats[$oid]['name']=$name;
		$cats[$oid]['subnames']=explode(',',$subname);
		
		$arr=array (
				'cats'=>serialize($cats) 
		);
		
		$str=sql_update($arr);
		$DB->query("update ".PF."channel set $str where id='$id'");
		
		yun_succeed('编辑成功','f');
	}
}

if(isset($_GET['del'])){
	$oid=(int)$_GET['oid'];
	$cats=$G['channels'][$id]['cats'];
	
	if(!isset($cats[$oid]))
		yun_error('参数错误');
	
	unset($cats[$oid]);
	
	$arr=array (
			'cat_'.$cats[$oid]['id']=>'0' 
	);
	$str=sql_update($arr);
	
	$DB->query("update ".PF."picture set $str");
	
	$arr=array (
			'cats'=>serialize($cats) 
	);
	
	$str=sql_update($arr);
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('删除成功','f');
}

if(IS_POST){
	
	yun_succeed('排序成功','f');
}

