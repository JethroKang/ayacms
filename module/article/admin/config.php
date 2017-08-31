<?php
$channel=$G['channels'][$id];

$configs=$channel['configs'];

if(IS_POST){
	
	$keywords=trim($_POST['keywords']);
	$description=trim($_POST['description']);
	$comment=!empty($_POST['comment']);
	
	$t_num=(int)$_POST['t_num'];
	$c_num=(int)$_POST['c_num'];
	$tc_num=(int)$_POST['tc_num'];
	
	$arr=array (
			'keywords'=>$keywords,
			'description'=>$description,
			'comment'=>$comment?1:0,
			'configs'=>serialize(array (
					't_num'=>$t_num,
					'c_num'=>$c_num,
					'tc_num'=>$tc_num 
			)) 
	);
	
	$str=sql_update($arr);
	
	$str=sql_update($arr);
	$DB->query("update ".PF."channel set $str where id='$id'");
	
	yun_succeed('提交成功');
}

extract($configs);

