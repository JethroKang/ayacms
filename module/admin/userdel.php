<?php


if(IS_POST){
	$ids=$_POST['ids'];
	is_array($ids) or yun_error('至少选择一项');
	foreach($ids as $id){
		$id=intval($id);
		if(!$u=$DB->fetch_first("select * from ".PF."user where id='$id'"))
			continue;
		if(count($ids)==1 && $user['id']==$id)
			yun_error('无法删除自己'); 
		if($user['id']==$id)
			continue;
		admin::user_del($id);
	}
	yun_succeed('删除成功','refresh');
}


$id=(int)$_GET['id'];

$u=$DB->fetch_first("select * from ".PF."user where id='$id'");

if($u['id']<1){
	yun_error('用户不存在');
}


$user['id']==$u['id']&&yun_error('无法删除自己');
if(admin::user_del($id)){
yun_succeed('删除成功','refresh');
}else
yun_succeed('删除失败');
